<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    //
    protected $primaryKey = 'work_order_id';

    protected $fillable = [
        'work_order', 'provider_id', 'deadline', 'order_notes'
    ];
}
