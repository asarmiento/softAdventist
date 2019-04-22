<?php


namespace App\Entities\Departaments;


use App\Entities\Entity;

class Specialties extends Entity
{
    protected $table ='specialties';


    public static function listsLabel()
    {
        $specialties = self::all();
        $lists = [];
        foreach ($specialties AS $specialty)
        {
            array_push($lists, ['label' =>  $specialty->name, 'value' => $specialty->id]);
        }

        return $lists;
    }

}
