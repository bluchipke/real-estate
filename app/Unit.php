<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $primaryKey = 'unit_id';

    protected $fillable = [
        'unit_number',
        'property_id',
        'unit_size',
        'unit_value',
        'vacant',
        'unit_status',
        'other_details',
        'unit_type_id',
        'unit_level'
    ];
}
