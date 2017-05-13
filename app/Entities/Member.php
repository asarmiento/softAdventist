<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 04:58 PM
 */



namespace App\Entities;



class Member extends Entity
{
    protected $timestamp;

    protected $fillable= ['name','last','bautizmoDate','birthdate','phone','cell','email','church_id','token'];

    public function getRules()
    {
        return [
            'name'    =>'required',
            'last'      =>'required',
            'church_id'    =>'required'
        ];
    }

    public function getExist()
    {
        // TODO: Implement getExist() method.
    }
    public function incomes()
    {
        return $this->belongsTo(Income::getClass(),'id','member_id');
    }
    public function nameComplete()
    {
        return $this->name. '  '.$this->last;
    }

    public function member($date){
        return $this->belongsTo(Member::getClass(),'member_id','id')->where('date',$date);
    }


    public function getUnique($rules, $datos)
    {
        // TODO: Implement getUnique() method.
    }
}
