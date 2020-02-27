<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    //
    protected $primaryKey = 'location_id';

    protected $fillable = [
        'location_name', 'location_slug', 'loc_notes'
    ];
}
