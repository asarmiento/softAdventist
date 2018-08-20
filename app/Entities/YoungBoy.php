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
    protected $fillable = ['code','church','age','birthdate','address','gender','user_id','name','last_name','email','launch'];


    public function getRules()
    {
        return ['code'=>'required',
            'church'=>'required',
            'birthdate'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'user_id'=>'required'];// TODO: Implement getRules() method.
    }


    public function getUnique($rules, $datos)
    {
        return $rules;// TODO: Implement getUnique() method.
    }

    public function retirements()
    {
        return $this->hasMany(Retirement::getClass());
    }

    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }

    public function church()
    {
        return $this->belongsTo(Church::class,'church','id');
    }

    public function churchD()
    {
        return $this->belongsTo(Church::class,'church','id');
    }

    public function nameComplete()
    {
        return $this->name.' '.$this->last_name;
    }
}