<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 04:58 PM
 */

namespace App\Entities;

class MissionOrAssociation extends Entity
{
    protected $fillable =['name'];
    public function getRules()
    {
        // TODO: Implement getRules() method.
    }


    public function getUnique($rules, $datos)
    {
        // TODO: Implement getUnique() method.
    }
}