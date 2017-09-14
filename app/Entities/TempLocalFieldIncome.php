<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TempLocalFieldIncome extends Entity
{
    //
    protected $fillable = ['balance','church_l_f_income_account_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function ChurchLFIncomeAccount()
    {
        return $this->belongsTo(ChurchLocalFieldIncomeAccount::class,'church_l_f_income_account_id');
    }
}
