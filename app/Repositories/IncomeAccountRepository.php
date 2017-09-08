<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 11/07/2017
 * Time: 12:47 PM
 */

namespace App\Repositories;

use App\Entities\Departaments\IncomeAccount;

class IncomeAccountRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return new IncomeAccount();// TODO: Implement getModel() method.
    }
    public function listSelects()
    {
        $contents = [];
        foreach ($this->filterChurchRelation('departament') AS $account):
            $value = ['value'=>$account->token, 'label'=>$account->name];
            array_push($contents,$value);
        endforeach;
        return $contents;
    }
    public function sumTypeForEnvelope($envelope,$type)
    {
        return $this->newQuery()->join('weekly_incomes','weekly_incomes.income_account_id','=','income_accounts.id')
            ->where('type',$type)->where('envelope_number',$envelope)->sum('weekly_incomes.balance');
    }

    public function sumTypeForInEnvelope($envelope,$type)
    {
        return $this->newQuery()->join('weekly_incomes','weekly_incomes.income_account_id','=','income_accounts.id')
            ->where('type',$type)->whereIn('envelope_number',$envelope)->sum('weekly_incomes.balance');
    }
}