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

    protected $fillable = [ 'name', 'address','phone', 'longitud', 'latitud', 'district_id','url','email','user_id' ];


    public function getRules()
    {
        // TODO: Implement getRules() method.
    }


    public function getUnique($rules, $datos)
    {
        // TODO: Implement getUnique() method.
    }

    public static function listsLabel()
    {
        $churchs = self::all();
        $lists = [];
        foreach ($churchs AS $church)
        {
            array_push($lists, ['label' =>  $church->name, 'value' => $church->id]);
        }

        return $lists;
    }
}
