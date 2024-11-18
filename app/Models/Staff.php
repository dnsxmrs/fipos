<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // Explicitly set the table name
    protected $table = 'staffs';

    protected $fillable = [
        'first_name'
        , 'last_name'
        , 'email'
        , 'phone_number'
        , 'address'
    ];
}
