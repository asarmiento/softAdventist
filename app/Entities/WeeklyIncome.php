<?php

namespace App\Entities;


use App\Entities\Departaments\IncomeAccount;

/**
 * @property mixed $internal_control
 */
class WeeklyIncome extends Entity
{
    protected  $fillable = ['balance','envelope_number','member_id','internal_control_id','income_account_id','status','token'];

    public function incomeAccount()
    {
        return $this->belongsTo(IncomeAccount::getClass());
    }

    public function member()
    {
        return $this->belongsTo(Member::getClass());
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-14
     * @TimeCreate: 10:00pm
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
