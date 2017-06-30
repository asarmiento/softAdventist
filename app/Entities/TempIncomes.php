<?php

namespace App\Entities;


class TempIncomes extends Entity
{
    protected $fillable = ['balance','income_account_id','user_id'];

    public function incomeAccount()
    {
        return $this->belongsTo(IncomeAccount::getClass());
    }
}
