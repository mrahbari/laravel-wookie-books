<?php
/**
 * Traits/Models/Sluggable.php
 *
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:00 PM
 */
namespace Base\Traits\Models;

use Cviebrock\EloquentSluggable\Sluggable;

/**
 * Class Slug
 * @package Base\Traits\Models
 */
trait SluggableTrait
{
    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
