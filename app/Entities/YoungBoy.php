<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 20/04/2017
 * Time: 06:22 PM
 */

namespace App\Entities;

class YoungBoy extends Entity
{
    protected $fillable = ['code'];
    public function getRules()
    {
        // TODO: Implement getRules() method.
    }


    public function getUnique($rules, $datos)
    {
        // TODO: Implement getUnique() method.
    }
}