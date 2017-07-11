<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 11/07/2017
 * Time: 01:29 PM
 */

namespace App\Repositories;

use App\Entities\WeeklyIncome;

class WeeklyincomeRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
       return new WeeklyIncome(); // TODO: Implement getModel() method.
    }

    public function sumInEnvelope($envelope,$id)
    {
        return $this->newQuery()->whereIn('envelope_number', $envelope)
            ->where('income_account_id', $id)->sum('balance');
    }
}