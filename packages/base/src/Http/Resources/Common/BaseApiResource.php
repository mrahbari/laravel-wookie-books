<?php
/**
 * Base\Http\Resources\Common\BaseApiResource.php
 *
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */

namespace Base\Http\Resources\Common;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseApiResource extends JsonResource
{

    /**
     * @var $columns
     */
    protected $columns;

    /**
     * @param array|null $columns
     * @return $this
     */
    public function columns(?array $columns = []): BaseApiResource
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * Resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        if (!empty($this->columns) && is_array($this->columns)) {
            $array = [];
            foreach ($this->columns as $column) {
                $array[$column] = !empty($this->$column) ? $this->$column : '';
            }
            return $array;
        }
        return parent::toArray($request);
    }
}
