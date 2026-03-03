<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutItem extends Model
{
    use HasFactory;

    protected $table = 'checkout_items';

    protected $fillable = [
        'checkout_id',
        'product_id',
        'product_name',
        'price',
        'discount_percent',
        'discount_amount',
        'qty',
        'subtotal',
    ];

    protected $casts = [
        'price'            => 'integer',
        'discount_percent' => 'integer',
        'discount_amount'  => 'integer',
        'qty'              => 'integer',
        'subtotal'         => 'integer',
    ];

    public function checkout()
    {
        return $this->belongsTo(Checkout::class, 'checkout_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
