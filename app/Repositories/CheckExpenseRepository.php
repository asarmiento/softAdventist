<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 17/07/2017
 * Time: 02:05 PM
 */

namespace App\Repositories;

use App\Entities\CheckExpense;

class CheckExpenseRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return new CheckExpense();// TODO: Implement getModel() method.
    }

    public function filterChurchRelationNot($relation)
    {
        return $this->newQuery()->whereHas($relation,function ($q){
            $q->where('church_id',1);
        })->where('status','no aplicado')->where('check_id',null)->get();
    }

    public function filterChurchRelationOk($relation,$status)
    {
        return $this->newQuery()->whereHas($relation,function ($q){
            $q->where('church_id',1);
        })->where('status',$status)->get();
    }
}