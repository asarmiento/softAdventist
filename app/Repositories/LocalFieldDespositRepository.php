<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 05/08/2017
 * Time: 06:41 PM
 */

namespace App\Repositories;

use App\Entities\LocalFieldDeposit;

class LocalFieldDespositRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return new LocalFieldDeposit(); // TODO: Implement getModel() method.
    }
}