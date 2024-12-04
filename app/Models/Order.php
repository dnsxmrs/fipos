<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    protected $fillable = [
        'order_number',
        'order_type',
        'total_price',
        'tax_amount',
        'discount_type',
        'discount_amount',
        'subtotal',
        'user_id',
        'status'
    ];

    // Relationsip with OrderProduct
    public function products()
    {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    // Relationship with User
    public function user()
    {
        $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relationship with Payment
    public function payment()
    {
        $this->belongsTo(Payment::class, 'payment_id', 'id');
    }
}
