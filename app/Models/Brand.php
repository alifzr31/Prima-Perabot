<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'brands';

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
        'logo',
        'is_active',
        'is_highlighted',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'is_active' => 'boolean',
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
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }
}
