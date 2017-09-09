<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class LocalFieldIncome extends Entity
{
    protected $fillable = ['envelope_number','status','member_id','internal_control_id','local_field_income_account_id',
        'balance','token'];

    public function localFieldIncomeAccount()
    {
        return $this->belongsTo(LocalFieldIncomeAccount::getClass());
    }
}
