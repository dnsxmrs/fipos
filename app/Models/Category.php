<?php
// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use SoftDeletes;

    protected $primaryKey = 'category_id'; // Define the primary key
    protected $fillable = [
        'category_name',
        'description',
        'type',
        'beverage_type',
        'image'
    ]; // Fillable fields

    // Define relationship with Product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
