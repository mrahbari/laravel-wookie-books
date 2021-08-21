<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:30 PM
 */

namespace Publisher\Traits;


/**
 * Trait AuthorAttributesTrait
 * @package Publisher\Traits
 */
trait AuthorAttributesTrait
{
    /**
     * Return FullName based on first and last name
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        $fullName = !empty($this->attributes['first_name']) ? $this->attributes['first_name'] : null;
        $fullName .= !empty($this->attributes['last_name']) ? ' ' . $this->attributes['last_name'] : null;
        return $fullName;
    }

    /**
     * Return trans_status
     * @return string
     */
    public function getStatusTransAttribute(): string
    {
        return !empty($this->attributes['status']) ? trans_status($this->attributes['status']) : $this->attributes['status'];
    }
}
