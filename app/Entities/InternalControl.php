<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class InternalControl extends Entity
{
    protected $fillable = [
        'number',
        'balance',
        'number_of_envelopes',
        'saturday',
        'token',
        'church_id'
    ];
}
