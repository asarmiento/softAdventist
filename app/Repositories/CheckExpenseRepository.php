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

    public function filterChurchRelationNot($relation,$check = null)
    {
        return $this->newQuery()->whereHas($relation,function ($q) {
            $q->where('church_id',1);
        })->where('status','no aplicado')->where('check_id',$check)->get();
    }

    public function filterChurchRelationOk($relation,$status)
    {
        return $this->newQuery()->whereHas($relation,function ($q){
            $q->where('church_id',1);
        })->where('status',$status)->get();
    }
    public function numeration()
    {
        $datas = $this->newQuery()->whereHas('expenseAccount.incomeAccount.departament',
            function ($q) {
                $q->where('church_id', 1);
            })->max('reference');

        return ($datas+1);
    }
    public function sumStatus($status,$check=null)
    {
        return $this->newQuery()->where('status', $status)->where('check_id',$check)->sum('balance');
    }
}