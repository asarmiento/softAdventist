<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 16/07/2017
 * Time: 03:51 PM
 */

namespace App\Entities;

class Check extends Entity
{

    protected $fillable = [
        'number',
        'name',
        'token',
        'detail',
        'bank_id',
        'type',
        'image',
        'date',
        'status',
        'balance',
        'user_id'
    ];


    public function bank()
    {
        return $this->belongsTo(Bank::getClass());
    }


    public function checkExpenses()
    {
        return $this->hasMany(CheckExpense::getClass());
    }


    public function internalControl()
    {
        return $this->belongsToMany(InternalControl::getClass(), 'check_i_c_by_l_f')->withPivot('balance',
                'token')->withTimestamps();
    }
}