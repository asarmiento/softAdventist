<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 12/07/2017
 * Time: 10:12 PM
 */

namespace App\Repositories;

use App\Entities\Bank;

class BankRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
       return new Bank(); // TODO: Implement getModel() method.
    }
}