<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'checkouts';

    /**
     * Primary key bukan auto increment
     */
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'order_number',
        'orderer_name',
        'orderer_email',
        'orderer_phone',
        'receiver_name',
        'receiver_address',
        'receiver_country',
        'receiver_province',
        'receiver_city',
        'receiver_district',
        'receiver_sub_district',
        'receiver_postal_code',
        'notes',
        'subtotal',
        'total_discount_amount',
        'grand_total',
        'status',
    ];

    /**
     * Casting
     */
    protected $casts = [
        'subtotal'            => 'integer',
        'total_discount_amount' => 'integer',
        'grand_total' => 'integer',
    ];

    public function checkoutItems()
    {
        return $this->hasMany(CheckoutItem::class, 'checkout_id', 'id');
    }
}
