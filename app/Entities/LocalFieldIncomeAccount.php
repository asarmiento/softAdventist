<?php

namespace App\Entities;


/**
 * Class LocalFieldIncomeAccount
 * @package App\Entities
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class LocalFieldIncomeAccount extends Entity
{
    //
    protected $fillable = ['name','balance','type','local_field_id'];

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-05
     * @TimeCreate: 10:40pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     *
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * ----------------------------------------------------------------------
     * *
     */
    public function localFieldIncomes()
    {
        return $this->hasMany(LocalFieldIncome::getClass());
    }

    public function churchLFIncomeAccount()
    {
        return $this->hasMany(ChurchLocalFieldIncomeAccount::class,'l_f_income_account_id');
    }
}

