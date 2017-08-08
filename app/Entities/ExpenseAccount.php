<?php

namespace App\Entities;


use App\Traits\DataViewerTraits;

class ExpenseAccount extends Entity
{
    protected $fillable = ['name', 'income_account_id', 'balance', 'token'];

    public static $columns = ['name', 'budget', 'percent_of_budget'];

    use DataViewerTraits;

    public function incomeAccount()
    {
        return $this->belongsTo(IncomeAccount::getClass());
    }


    public function scopeSearch($query, $search)
    {
        if (trim($search) != "") {
            $query->whereHas("incomeAccount", function ($q) use ($search) {
                $q->where("name", "LIKE", "%$search%");
            })->orWhere("name", "LIKE", "%$search%")
                ->orWhere("balance", "LIKE", "%$search%");
        }

    }
}
