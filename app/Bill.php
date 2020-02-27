<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    //
    protected $primaryKey = 'bill_id';

    protected $fillable = [
        'bill_desc', 'unit_id', 'property_id', 'included_rent', 'bill_date', 'bill_notes', 'bill_amount', 'provider_id'
    ];
}
