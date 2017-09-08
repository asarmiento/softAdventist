<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 07/09/2017
 * Time: 10:41 PM
 */

namespace App\Repositories;


use App\Entities\Country;

class CountryRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
       return new Country(); // TODO: Implement getModel() method.
    }
}