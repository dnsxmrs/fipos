<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{

    protected $fillable = [
        'order_id',
        'amount',
        'description',
        'mode_of_payment',
        'status'
    ];


    // Relationship with Order
    public function orders()
    {
        $this->hasMany(Order::class);
    }
}
