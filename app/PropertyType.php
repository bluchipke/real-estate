<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    //
    protected $primaryKey = "property_type_id";

    protected $fillable = [
        'property_type_name', 'type_notes', 'property_type_slug'
    ];
}
