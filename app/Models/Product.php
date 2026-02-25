<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'products';

    /**
     * Primary key bukan auto increment
     */
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'sku',
        'price',
        'discount_percent',
        'stock',
        'is_active',
        'is_hot_sale',
        'is_highlighted',
        'brand_id',
        'category_id',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'price'            => 'integer',
        'discount_percent' => 'integer',
        'stock' => 'integer',
        'is_active' => 'boolean',
        'is_hot_sale' => 'boolean',
        'is_highlighted' => 'boolean',
    ];

    /**
     * Optional: Route Model Binding pakai slug
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function productImage()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function finalPriceAfterDiscount()
    {
        if (!$this->discount_percent) {
            return $this->price;
        }

        return (int) round(
            $this->price - ($this->price * $this->discount_percent / 100)
        );
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getFormattedFinalPriceAttribute()
    {
        $final = $this->discount_percent
            ? $this->price - ($this->price * $this->discount_percent / 100)
            : $this->price;

        return 'Rp ' . number_format((int) round($final), 0, ',', '.');
    }
}
