<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'order_number',
        'order_type',
        'total_price',
        'user_id',
        'status'
    ];

    // Relationsip with OrderProduct
    public function products()
    {
        $this->hasMany(Product::class);
    }

    // Relationship with User
    public function user()
    {
        $this->belongsTo(User::class);
    }

    // Relationship with Payment
    public function payment()
    {
        $this->belongsTo(Payment::class);
    }
}
