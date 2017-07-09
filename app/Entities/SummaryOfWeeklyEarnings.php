<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class SummaryOfWeeklyEarnings extends Entity
{
    protected $fillable = ['number','offering', 'sixty','forty','tithes','other_church','other','internal_control_id','token'];

    public function internal_control()
    {
        return $this->belongsTo(InternalControl::getClass());
    }
}
