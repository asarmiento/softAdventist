<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 04:01 PM
 */

namespace App\Entities;

class Visitor extends Entity
{
    protected $fillable = ['ip','date'];
    public function getRules()
    {
       return []; // TODO: Implement getRules() method.
    }


    public function getUnique($rules, $datos)
    {
        // TODO: Implement getUnique() method.
    }
}