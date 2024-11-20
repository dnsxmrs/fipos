<?php
// app/Models/Category.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{

    use LogsActivity;

    protected $primaryKey = 'category_id'; // Define the primary key
    protected $fillable = [
        'category_name'
        , 'image'
    ]; // Fillable fields

    // Define relationship with Product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }


    /** Activity that will be log if changed or created */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([

                'category_name',
                'emage',

            ])
            ->useLogName('category_activity') // Customize log name
            ->logOnlyDirty(); // Log only changes, not all attributes
    }
}
