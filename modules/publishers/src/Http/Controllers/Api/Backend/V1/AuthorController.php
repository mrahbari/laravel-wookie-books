<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 16:54 PM
 */

namespace Publisher\Http\Controllers\Api\Backend\V1;

use Publisher\Http\Requests\Backend\AuthorsRequest;
use Publisher\Services\Backend\AuthorService;
use Base\Http\Controllers\Backend\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController extends BaseApiController
{
    /**
     * AuthorController constructor.
     * @param AuthorService $service
     */
    public function __construct(AuthorService $service)
    {
        parent::__construct();
        $this->service = $service;
        $this->apiAllColumns = config('publishers.authors.api_columns.backend_all');
        $this->apiColumns =config('publishers.authors.api_columns.backend_list');
        $this->apiOnlyColumns =config('publishers.authors.api_columns.backend_limited');
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $data = $this->service->index($request->toArray());
        $extra = ['message' => trans('base::modules.actions.index')];
        return $this->apiOk($data, $extra, $this->apiColumns, true);
    }


    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id): JsonResponse
    {
        $data = $this->service->show($id);
        $extra = ['message' => trans('base::modules.actions.show')];
        return $this->apiOk($data, $extra, $this->apiAllColumns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AuthorsRequest $request
     * @return JsonResponse
     */
    public function store(AuthorsRequest $request): JsonResponse
    {
        /* try {*/
        $data = $this->service->store($request->only($this->apiOnlyColumns));
        return $this->apiCreated($data, null, $this->apiColumns);

        /*} catch (Exception $e) {
            $extra = ['message' => $e->getMessage()];
            return $this->apiFailed(null, $extra, $this->apiColumns);
        }*/
    }


    /**
     * Update the specified resource in table.
     *
     * @param AuthorsRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id): JsonResponse
    {
        /*try {*/
        $data = $this->service->update($request->only($this->apiOnlyColumns), $id);
        return $this->apiUpdated($data, null, $this->apiColumns);
        /*} catch (Exception $e) {
            $extra = ['message' => $e->getMessage()];
            return $this->apiFailed(null, $extra, $this->apiColumns);
        }*/
    }

    /**
     * Remove the specified resource from table.
     *
     * @param AuthorsRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function destroy(Request $request, $id): JsonResponse
    {
        /*try {*/
        $this->service->destroy($id);
        return $this->apiDeleted(null, null, $this->apiColumns);
        /*} catch (Exception $e) {
            $extra = ['message' => $e->getMessage()];
            return $this->apiFailed(null, $extra, $this->apiColumns);
        }*/
    }

}
