<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'item_name',
        'category_id',
        'stock',
        'unit',
        'reorder_level',
        'last_restocked',
        'expiry_date',
        'status'

    ];


    public function category()
    {
        return $this->belongsTo(InventoryCategory::class, 'category_id', 'id');
    }
}
