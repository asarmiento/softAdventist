<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 12/07/2017
 * Time: 03:47 PM
 */

namespace App\Repositories;

use App\Entities\Departaments\ExpenseAccount;

/**
 * Class ExpenseAccountRepository
 * @package App\Repositories
 */
class ExpenseAccountRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
      return new ExpenseAccount();  // TODO: Implement getModel() method.
    }

    public function listSelects()
    {
        $contents = [];
        $accounts = $this->newQuery()->whereHas('incomeAccount',function ($q){
            $q->whereHas('departament',function ($e){
                $e->where('church_id',1);
            });
        })->get();
        foreach ($accounts AS $account):
            $value = ['value'=>$account->token, 'label'=>$account->name];
            array_push($contents,$value);
        endforeach;
        return $contents;
    }
}