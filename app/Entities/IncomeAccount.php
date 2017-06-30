<?php

namespace App\Entities;


class IncomeAccount extends Entity
{
    protected $fillable = ['name','departament_id','balance','token','type'];

    public function departament()
    {
        return $this->belongsTo(Departament::getClass());
    }

    public function weeklyIncomes()
    {
        return $this->hasMany(WeeklyIncome::getClass());
    }
}
