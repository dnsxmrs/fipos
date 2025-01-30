<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{

    use SoftDeletes;

    // Explicitly set the table name
    protected $table = 'staffs';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address'
    ];
}
