<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 16/07/2017
 * Time: 03:34 PM
 */

namespace App\Repositories;

use App\Entities\Check;

class CheckRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return new Check();// TODO: Implement getModel() method.
    }
}