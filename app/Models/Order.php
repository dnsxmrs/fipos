<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'name',
        'description',
        'order_type',
        'product_id',
        'order_status'
    ];
}