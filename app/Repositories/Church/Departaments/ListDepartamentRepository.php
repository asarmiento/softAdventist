<?php
namespace App\Repositories\Church\Departaments;

use App\Entities\Departaments\ListDepartament;
use App\Repositories\BaseRepository;

/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 24/08/2017
 * Time: 02:32 PM
 */

class ListDepartamentRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return new ListDepartament();// TODO: Implement getModel() method.
    }
}