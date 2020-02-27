<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $primaryKey = 'activity_id';

    protected $fillable = [
        'activity_name', 'work_order_id'
    ];
}
