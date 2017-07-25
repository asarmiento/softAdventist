<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ChurchDeposit extends Entity
{
    protected $fillable = ['number','date','balance','bank_id','user_id','token'];

    public $timestamps = true;

    public function internalControls()
    {
        return $this->belongsToMany(InternalControl::getClass())->withPivot('balance','user_id')->withTimestamps();
    }

    public function bank()
    {
        return $this->belongsTo(Bank::getClass());
    }
}
