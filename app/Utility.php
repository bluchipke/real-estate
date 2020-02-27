<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utility extends Model
{
    //
    protected $primaryKey = 'utility_id';

    protected $fillable = [
        'utility_name', 'utility_notes', 'billable'
    ];
}
