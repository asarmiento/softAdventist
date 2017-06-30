<?php

namespace App\Entities;


class LocalFieldIncomeAccount extends Entity
{
    //

    public function localFieldIncomes()
    {
        return $this->hasMany(LocalFieldIncome::getClass());
    }
}

