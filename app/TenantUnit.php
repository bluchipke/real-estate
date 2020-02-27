<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantUnit extends Model
{
    //
    protected $primaryKey = 'tenant_unit_id';

    protected $fillable = [
        'tenant_id', 'property_id', 'unit_id', 'deposit_amount', 'occupation_date', 'occupation_notes'
    ];
}
