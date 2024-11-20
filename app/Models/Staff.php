<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Staff extends Model
{

    use LogsActivity;

    // Explicitly set the table name
    protected $table = 'staffs';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address'
    ];

    /** Activity that will be log if changed or created */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([

                'first_name',
                'last_name',
                'email',
                'phone_number',
                'address'

            ])
            ->useLogName('staff_activity') // Customize log name
            ->logOnlyDirty(); // Log only changes, not all attributes
    }
}
