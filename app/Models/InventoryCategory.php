<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryCategory extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'category_name',
        'description',
        'image',

    ];


    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
