<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total_price'
    ];

    // Relationship with Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship with Products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
