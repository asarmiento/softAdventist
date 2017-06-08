<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 20/04/2017
 * Time: 06:19 PM
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

abstract class Entity extends Model
{

    public static function getClass() {
        return get_class(new static);
    }


}