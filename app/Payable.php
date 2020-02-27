<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    //
    protected $primaryKey = 'payable_id';

    protected $fillable = [
        'bill_id', 'provider_id', 'paid_by', 'amount_paid', 'payment_notes', 'reference', 'trans_date', 'payment_mode'
    ];
}
