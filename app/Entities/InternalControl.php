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

    public function localFieldIncomeAccounts()
    {
        return $this->belongsToMany(LocalFieldIncomeAccount::getClass(),'local_field_incomes')
            ->withPivot('envelope_number','balance','status');
    }

    public function churchDeposit()
    {
        return $this->belongsToMany(ChurchDeposit::getClass())->withPivot('balance','user_id')->withTimestamps();
    }
}
