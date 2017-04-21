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
    protected $fillable = ['code','church','age','address','gender','user_id'];


    public function getRules()
    {
        return ['code'=>'required',
            'church'=>'required',
            'age'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'user_id'=>'required'];// TODO: Implement getRules() method.
    }


    public function getUnique($rules, $datos)
    {
        return $rules;// TODO: Implement getUnique() method.
    }
}