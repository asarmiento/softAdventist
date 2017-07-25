<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 13/07/2017
 * Time: 12:32 PM
 */

namespace App\Repositories;

use App\Entities\ChurchDeposit;

class ChurchDepositRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
       return new ChurchDeposit(); // TODO: Implement getModel() method.
    }

    public function listDeposits()
    {
        return $this->newQuery()->whereHas('bank',function ($q){
            $q->where('church_id',1);
        })->with('bank')->get();
    }
}