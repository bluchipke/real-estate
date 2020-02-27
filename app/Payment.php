<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'tenant_id', 'unit_id', 'amount_paid', 'paid_by', 'slip_no', 'payment_date', 'payment_method', 'payment_notes'
    ];
}
