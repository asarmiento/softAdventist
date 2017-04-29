<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 04:57 PM
 */

namespace App\Entities;

class Church extends Entity
{
    protected $fillable = ['name','address','longitud','latitud','mission_or_association_id'];
    public function getRules()
    {
        // TODO: Implement getRules() method.
    }


    public function getUnique($rules, $datos)
    {
        // TODO: Implement getUnique() method.
    }
}