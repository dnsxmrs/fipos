<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name'
        , 'product_description'
        , 'product_price'
        , 'category_id'
        , 'isAvailable'
        , 'image'
    ];

    // Define relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
