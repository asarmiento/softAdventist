<?php

namespace App\Entities;


class ExpenseAccount extends Entity
{
    protected $fillable = ['name','income_account_id','balance','token'];

    public function incomeAccount()
    {
        return $this->belongsTo(IncomeAccount::getClass());
    }
}
