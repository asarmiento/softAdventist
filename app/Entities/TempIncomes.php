<?php

namespace App\Entities;


use App\Entities\Departaments\IncomeAccount;

class TempIncomes extends Entity
{
    protected $fillable = ['balance','income_account_id','user_id'];

    public function incomeAccount()
    {
        return $this->belongsTo(IncomeAccount::getClass());
    }
}
