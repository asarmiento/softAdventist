<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 12/07/2017
 * Time: 03:47 PM
 */

namespace App\Repositories;

use App\Entities\ExpenseAccount;

class ExpenseAccountRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
      return new ExpenseAccount();  // TODO: Implement getModel() method.
    }
}