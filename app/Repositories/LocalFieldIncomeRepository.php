<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 11/07/2017
 * Time: 01:31 PM
 */

namespace App\Repositories;

use App\Entities\LocalFieldIncome;

class LocalFieldIncomeRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
       return new LocalFieldIncome(); // TODO: Implement getModel() method.
    }

    public function sumInEnvelope($envelope,$id)
    {
        return $this->newQuery()->whereIn('envelope_number', $envelope)
            ->where('church_l_f_income_account_id', $id)->sum('balance');
    }

    public function typeEnvelopeSum($envelope,$type){
       return $this->newQuery()->whereHas('localFieldIncomeAccount',function ($q) use($type){
           $q->whereHas('localFieldIncomeAccount',function ($r) use ($type){
               $r->where('type',$type);
           });
       })->where('envelope_number', $envelope)->sum('local_field_incomes.balance');
    }

    public function typeEnvelopeAll($type){
        return $this->newQuery()->whereHas('localFieldIncomeAccount',function ($q) use($type){
            $q->whereHas('localFieldIncomeAccount',function ($r) use ($type){
                $r->where('type',$type);
            });
        });
    }
}