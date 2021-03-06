<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 11/07/2017
 * Time: 12:41 PM
 */

namespace App\Repositories;

use App\Entities\LocalFieldIncomeAccount;

class LocalFieldIncomeAccountRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
       return new LocalFieldIncomeAccount(); // TODO: Implement getModel() method.
    }

    public function sumTypeForEnvelope($envelope,$type)
    {
       return ($this->newQuery()->join('local_field_incomes','local_field_incomes.church_l_f_income_account_id','=','church_local_field_income_accounts.id')
            ->where('type',$type)->where('envelope_number',$envelope)->sum('local_field_incomes.balance'));

    }

    public function sumTypeForInEnvelope($envelopes,$type)
    {
        return $this->newQuery()->join('local_field_incomes','local_field_incomes.church_l_f_income_account_id','=','church_local_field_income_accounts.id')
            ->where('type',$type)->whereIn('envelope_number',$envelopes)->sum('local_field_incomes.balance');
    }
}