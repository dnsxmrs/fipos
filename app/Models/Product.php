<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{

    use LogsActivity, SoftDeletes;

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

    /** Activity that will be log if changed or created */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([

                'product_name',
                'product_description',
                'product_price',
                'isAvailable',
                'has_customization',
                'image',
                'category_id',

            ])
            ->useLogName('product_activity') // Customize log name
            ->logOnlyDirty(); // Log only changes, not all attributes
    }
}
