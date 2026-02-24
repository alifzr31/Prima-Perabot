<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'categories';

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
        'icon',
        'is_active',
        'is_popular',
        'is_highlighted',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'is_highlighted' => 'boolean',
    ];

    /**
     * Optional: Route Model Binding pakai slug
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
