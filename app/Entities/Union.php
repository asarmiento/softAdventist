<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 07/09/2017
 * Time: 10:40 PM
 */

namespace App\Entities;


/**
 * Class Union
 * @package app\Entities
 */
class Union extends Entity
{

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}