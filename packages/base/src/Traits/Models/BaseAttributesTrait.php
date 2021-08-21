<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */

namespace Base\Traits\Models;


use Exception;
use Illuminate\Contracts\Routing\UrlGenerator;

/**
 * Trait EntityAttributesTraits
 *
 *
 * note: you can use both $this->attributes['published_at'] or $this->published_at to return values of attributes
 * @package Base\Traits
 */
trait BaseAttributesTrait
{
    /**
     * Route Key
     * @return string|null
     */
     public function getRouteKeyAttribute(): ?string
     {
        return !empty($this->attributes['id']) ? hashids_encode($this->attributes['id']) : null;
    }

    /**
     * Public Key
     *
     * @return string
     * @throws Exception
     */
    public function getPublicKeyAttribute(): string
    {
        return !empty($this->attributes['slug']) ? $this->attributes['slug'] : random_int(100000, 550000) . '-pub';
    }

}
