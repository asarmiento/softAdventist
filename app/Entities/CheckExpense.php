<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 17/07/2017
 * Time: 02:04 PM
 */

namespace App\Entities;

use App\Entities\Departaments\ExpenseAccount;
use App\Traits\DataViewerTraits;

class CheckExpense extends Entity
{
    protected $fillable = ['number','reference','date','expense_account_id','detail',
        'balance','user_id','image','token','check_id'];
    public static $columns = [ 'name','budget','percent_of_budget' ];

    use DataViewerTraits;

    public function scopeSearch($query, $search){
        if(trim($search) != ""){
            $query->whereHas("expenseAccount", function ($q) use ($search) {
                $q->where("name", "LIKE", "%$search%");
            })->orWhere("number","LIKE","%$search%")
                ->orWhere("reference","LIKE","%$search%")
                ->orWhere("balance","LIKE","%$search%")
                ->orWhere("detail","LIKE","%$search%")
                ->orWhere("date","LIKE","%$search%");
        }

    }
    public function expenseAccount()
    {
        return $this->belongsTo(ExpenseAccount::getClass());
    }

    public function check()
    {
        return $this->belongsTo(Check::getClass());
    }
}