<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceCharge extends Model
{
    //
    protected $primaryKey = 'service_charge_id';

    protected $fillable = [
        'service_charge', 'billable', 'service_notes'
    ];
}
