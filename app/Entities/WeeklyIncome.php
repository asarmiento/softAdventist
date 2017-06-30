<?php

namespace App\Entities;


class WeeklyIncome extends Entity
{
    protected  $fillable = ['balance','envelope_number','member_id','internal_control_id','income_account_id','status','token'];

    public function incomeAccount()
    {
        return $this->belongsTo(IncomeAccount::getClass());
    }

    public function member()
    {
        return $this->belongsTo(Member::getClass());
    }

}
