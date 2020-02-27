<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Landlord extends Model
{
    //
    protected $primaryKey = 'landlord_id';

    protected $fillable = [
        'first_name', 'last_name', 'postal_address', 'postal_code', 'phone_number', 'email_address', 'billing_type', 'percentage', 'bank_name', 'bank_account', 'kra_pin'
    ];
}
