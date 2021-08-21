<?php
/**
 * Base\Http\Resources\Common\BaseApiCollection.php
 *
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 *
 * note: https://stackoverflow.com/questions/50638257/laravel-5-6-pass-additional-parameters-to-api-resource
 */

namespace Base\Http\Resources\Common;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseApiCollection extends ResourceCollection
{

    /**
     * @var $columns
     */
    protected $columns;

    /**
     * @param array|null $columns
     * @return $this
     */
    public function columns(?array $columns = []): BaseApiCollection
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->collection->map(function (BaseApiResource $resource) use ($request) {
            return $resource->columns($this->columns)->toArray($request);
        })->all();

        //return parent::toArray($request);
    }
}
