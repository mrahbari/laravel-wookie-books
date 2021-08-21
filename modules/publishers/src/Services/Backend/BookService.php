<?php
/**
 * Services\BookService.php
 *
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 17:47 PM
 */


namespace Publisher\Services\Backend;

use Publisher\Models\Book;
use Illuminate\Support\Facades\Gate;

class BookService
{
    /**
     * BookService constructor.
     */
    public function __construct()
    {
    }

    /**
     * Paginating Query Builder Results
     *
     * @param array $params
     * @return mixed
     */
    public function index(array $params = [])
    {
        $q = !empty($params['q']) ? $params['q'] : null;
        $limit = !empty($params['limit']) ? $params['limit'] : config('publishers.settings.maximum_page_size');

        return Book::search($q)->latest()->paginate($limit);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return mixed|null
     */
    public function show($id)
    {
        $id = hashids_decode($id);
        return Book::findOrFail($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes)
    {
        //Determine whether the user can create new record
        if(!Gate::allows('create', Book::class)) {
            abort(403, trans('base::exception.authorization.exception'));
        }

        $attributes['created_by'] = get_user_id();
        return Book::create($attributes);
    }

    /**
     * @param array $attributes
     * @param $id
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        // Decode ID and find it
        $id = hashids_decode($id);
        $model = Book::findOrFail($id);

        //Determine whether the user can update the model.
        if(!Gate::allows('update', $model)) {
            abort(403, trans('base::exception.authorization.exception'));
        }

        //Set Attributes values
        $attributes['updated_by'] = get_user_id();
        $attributes['updated_at'] = now();
        $model->fill($attributes);
        $model->save();
        return $model;
    }


    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        // Decode ID and find it
        $id = hashids_decode($id);
        $model = Book::withTrashed()->findOrFail($id);

        //Determine whether the user can delete the model.
        if(!Gate::allows('delete', $model)) {
            abort(403, trans('base::exception.authorization.exception'));
        }

        //Handle deleted records
        if (!empty($model->deleted_by) || !empty($model->deleted_at)) {
            abort(401, trans('base::exception.destroyed.exception'));
        }

        //Set Attributes values
        $attributes['deleted_by'] = get_user_id();
        $model->fill($attributes);
        $model->save();

        // Do Delete
        return $model->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function unPublish($id)
    {
        // Decode ID and find it
        $id = hashids_decode($id);
        $model = Book::withTrashed()->findOrFail($id);

        //Determine whether the user can delete the model.
        if(!Gate::allows('unPublish', $model)) {
            abort(403, trans('base::exception.authorization.exception'));
        }

        if (!empty($model->deleted_by) || !empty($model->deleted_at))
            abort(401, trans('base::exception.un_publish.exception'));

        //Set Attributes values
        $attributes['deleted_by'] = get_user_id();
        $model->fill($attributes);
        $model->save();

        // Do Delete
        return $model->delete();
    }


}
