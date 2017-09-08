<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TempLocalFieldIncome extends Entity
{
    //
    protected $fillable = ['balance','local_field_income_account_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function localFieldIncomeAccount()
    {
        return $this->belongsTo(LocalFieldIncomeAccount::getClass());
    }
}
