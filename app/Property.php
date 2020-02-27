<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    //
    protected $primaryKey = "property_id";

    protected $fillable = [
        'landlord_id', 'property_type_id', 'property_name', 'units_count', 'location_id', 'main_street', 'no_floors', 'estate_id', 'constituency', 'county', 'property_slug' 
    ];
}
