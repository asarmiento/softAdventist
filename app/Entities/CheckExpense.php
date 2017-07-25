<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 17/07/2017
 * Time: 02:04 PM
 */

namespace App\Entities;

class CheckExpense extends Entity
{
    protected $fillable = ['number','date','expense_account_id','detail',
        'balance','user_id','image','token','check_id'];

    public function expenseAccount()
    {
        return $this->belongsTo(ExpenseAccount::getClass());
    }
}