<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:30 PM
 */
namespace Publisher\Models;

use Publisher\Traits\AuthorAttributesTrait;
use Base\Models\BaseModel;
use Base\Traits\Models\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static search($q)
 * @method static findOrFail(array|\Hashids\Hashids|mixed|null $id)
 * @method static create(array $attributes)
 * @method static find(int $authorId)
 * @method static latest(string $string)
 */
class Author extends BaseModel
{
    use AuthorAttributesTrait;
    use SluggableTrait;

    /**
     * Configuration for the model.
     *
     * @var array
     */
    protected $config = 'publishers.authors';

    /**
     * Author constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $config = config($this->config);
        foreach ($config as $key => $val) {
            if (property_exists(static::class, $key)) {
                $this->$key = $val;
            }
        }
        parent::__construct($attributes);
    }

    /**
     * Scope a query to search model
     *
     * @param Builder $query
     * @param string|null $search
     * @return Builder|null
     */
    public function scopeSearch(Builder $query, ?string $search): ?Builder
    {
        if ($search) {
            return $query
                ->where('first_name', 'LIKE', "%{$search}%")
                ->orWhere('last_name', 'LIKE', "%{$search}%");
        }
        return null;
    }

    /**
     * Scope a query to order posts by latest rows
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeLatest(Builder $query): Builder
    {
        return $query->orderBy('priority', 'desc')->orderBy('created_at', 'desc');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => config('publishers.authors.slug')       //['first_name', 'last_name'],//
            ]
        ];
    }

    /**
     * Get the books records associated with the type.
     * @return HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'author_id');
    }
}
