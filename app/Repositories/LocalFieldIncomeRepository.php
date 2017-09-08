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
            ->where('local_field_income_account_id', $id)->sum('balance');
    }
}