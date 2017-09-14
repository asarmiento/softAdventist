<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class LocalFieldIncome extends Entity
{
    protected $fillable = ['envelope_number','status','member_id','internal_control_id','church_l_f_income_account_id',
        'balance','token'];

    public function churchLFIncomeAccount()
    {
        return $this->belongsTo(ChurchLocalFieldIncomeAccount::class,'church_l_f_income_account_id');
    }
}
