<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 11/09/2017
 * Time: 05:19 PM
 */

namespace App\Entities;


/**
 * Class ChurchLocalFieldincomeAccount
 * @package app\Entities
 * @property mixed $local_field_income_account
 * @property mixed $church
 * @property \Carbon\Carbon $created_at
 */
class ChurchLocalFieldIncomeAccount extends Entity
{
    protected $fillable = ['church_id','l_f_income_account_id','balance'];


    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-11
     * @TimeCreate: 5:23pm
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
    public function church(){
        return $this->belongsTo(Church::class);
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-11
     * @TimeCreate: 5:23pm
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
    public function localFieldIncomeAccount()
    {
        return $this->belongsTo(LocalFieldIncomeAccount::class,'l_f_income_account_id');
    }
}