<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{

    protected $primaryKey = "provider_id";

    protected $fillable = [
        'provider_name', 'provider_email', 'business_location', 'phone_no', 'provider_notes', 'provider_address'
    ];


    //
}
