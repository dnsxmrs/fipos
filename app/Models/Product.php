<?php
// app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{

    use LogsActivity;

    protected $fillable = [
        'product_name',
        'product_description',
        'product_price',
        'category_id',
        'isAvailable',
        'image'
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
                'category_id',
                'isAvailable',
                'image'

            ])
            ->useLogName('product_activity') // Customize log name
            ->logOnlyDirty(); // Log only changes, not all attributes
    }
}
