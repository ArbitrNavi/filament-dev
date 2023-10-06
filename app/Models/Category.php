<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;


/**
 * Class Category
 *
 * @property int $id
 * @property string $title
 * @property boolean $is_active
 * @property int $priority
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property Collection $product
 */
class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categories';

    protected $casts = [
        'is_active' => 'boolean',
    ];

//    protected $appends = [
//        'products'
//    ];

    protected $fillable = [
        'priority',
        'title',
        'is_active',
        'created_at'
    ];

    public function getProductsAttribute(): HasMany
    {
        return self::products()->where('is_active', true)->orderBy('priority');
    }

    public function products() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
