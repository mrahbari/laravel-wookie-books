<?php
/**
 * @author Mojtaba Rahbari <mojtaba.rahbari@gmail.com | mojtabarahbari.ir>
 * @copyright Copyright &copy; from 2021 Mike.
 * @version 1.0.0
 * @date 2021/08/20 15:30 PM
 */
namespace Publisher\Models;

use Base\Models\BaseModel;
use Base\Traits\Models\SluggableTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Publisher\Traits\BookAttributesTrait;

/**
 * @method static search(mixed|null $q)
 * @method static findOrFail(array|\Hashids\Hashids|mixed|null $id)
 * @method static create(array $attributes)
 */
class Book  extends BaseModel
{
    use BookAttributesTrait;
    use SluggableTrait;

    /**
     * Configuration for the model.
     *
     * @var array
     */
    protected $config = 'publishers.books';

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
     * Get belong to record
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class)->select('*');
    }

    /**
     * Query Search
     * @param $query
     * @param string|null $search
     */
    public function scopeSearch($query, ?string $search)
    {
        if($search)
        {
            $query->where(function ($q) use ($search){
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
                
                $q->orwhereHas('author', function ($qr) use ($search){
                    $qr->where('first_name', 'LIKE', "%{$search}%")
                        ->orWhere('last_name', 'LIKE', "%{$search}%");
                });
            });
        }
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
}
