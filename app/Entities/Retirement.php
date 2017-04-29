<?php
/**
 * Created by PhpStorm.
 * User: anwarsarmiento
 * Email: asarmiento@sistemasamigables.com
 * Date: 20/4/17
 * Time: 19:50
 */

namespace App\Entities;


class Retirement extends Entity
{
    protected $fillable = ['date','shirt_size','payment_method','amount','voucher','bank','young_boy_id'];


    public function getRules()
    {
        return ['date'=>'required',
            'shirt_size'=>'required',
            'payment_method'=>'required',
            'amount'=>'required',
            'voucher'=>'required',
            'young_boy_id'=>'required',
            'bank'=>'required'];// TODO: Implement getRules() method.
    }


    public function getUnique($rules, $datos)
    {
        return $rules;// TODO: Implement getUnique() method.
    }
}