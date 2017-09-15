<?php

namespace App\Entities;

/**
 * @property mixed $internal_control
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class LocalFieldIncome extends Entity
{
    protected $fillable = ['envelope_number','status','member_id','internal_control_id','church_l_f_income_account_id',
        'balance','token'];

    public function churchLFIncomeAccount()
    {
        return $this->belongsTo(ChurchLocalFieldIncomeAccount::class,'church_l_f_income_account_id');
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-14
     * @TimeCreate: 10:14pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     *
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * ----------------------------------------------------------------------
     * *
     */
    public function internalControl()
    {
        return $this->belongsTo(InternalControl::class);
    }


}
