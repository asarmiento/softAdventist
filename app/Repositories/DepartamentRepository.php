<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 03/09/2017
 * Time: 04:52 PM
 */

namespace app\Repositories;


use App\Entities\Departaments\Departament;

/**
 * Class DepartamentRepository
 * @package app\Repositories
 */
class DepartamentRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return new Departament();// TODO: Implement getModel() method.
    }
}