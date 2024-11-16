<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'first_name'
        , 'last_name'
        , 'email'
        , 'phone_number'
        , 'adress'
    ];
}
