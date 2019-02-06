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

    public function district()
    {
        return $this->belongsTo(District::class);
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

    public static function listsLabelCampo()
    {

        if(userCampo()) {
            $churchs = self::whereHas('district',function ($q){
                $q->where('local_field_id',userCampo());
            })->get();
        }elseif(userUnion()) {
            $churchs = self::whereHas('district',function ($q){
                $q->whereHas('localField',function ($r){
                    $r->where('union_id',userUnion());
                });
            })->get();
        }
        $lists = [];
        foreach ($churchs AS $church)
        {
            array_push($lists, ['label' =>  $church->name, 'value' => $church->id]);
        }

        return $lists;
    }
}
