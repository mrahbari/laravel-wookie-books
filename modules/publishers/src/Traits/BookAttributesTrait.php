<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:44 PM
 */

namespace Publisher\Traits;

/**
 * Trait BookAttributesTrait
 * @package Publisher\Traits
 */
trait BookAttributesTrait
{


    /**
     * Return trans_status
     * @return string
     */
    public function getStatusTransAttribute(): string
    {
        return !empty($this->attributes['status']) ? trans_status($this->attributes['status']) : $this->attributes['status'];
    }
}
