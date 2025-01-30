<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'isAvailable',
        'has_customization',
        'image',
        'category_id',
    ];

    // Define relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    // relationship with orderproducts
    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
