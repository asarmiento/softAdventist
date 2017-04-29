<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 20/04/2017
 * Time: 06:19 PM
 */

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

abstract class Entity extends Model
{
    abstract public function getRules();

    abstract public function getUnique($rules,$datos);

    public static function getClass() {
        return get_class(new static);
    }

    public function isValid($data) {

        $rules  = $this->getRules();

        if ($this->exists) {
            $rules  =  $this->getUnique($rules,$data);
        }

        $validator = \Validator::make($data, $rules);

        if ($validator->passes()) {
            return true;
        }

        $this->errors = $validator->errors();

        return false;
    }
}