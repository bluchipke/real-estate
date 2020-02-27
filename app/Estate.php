<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    //
    protected $primaryKey = 'estate_id';

    protected $fillable = [
        'estate_name', 'estate_slug', 'estate_notes'
    ];
}
