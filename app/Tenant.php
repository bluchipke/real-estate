<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    //
    protected $primaryKey = 'tenant_id';

    protected $fillable = [
        'first_name', 
        'last_name',
        'tenant_email',
        'phone_number',
        'id_card_passport',
        'tenant_code',
        'tenant_type',
        'nssf_number',
        'nhif_number',
        'kra_pin',
        'gender',
        'marital_status',
        'dob',
        'postal_address',
        'postal_code',
        'begin_date',
        'property_id',
        'unit_id',
        'employer_name',
        'employer_contact',
        'job_title',
        'allocated'
    ];
}
