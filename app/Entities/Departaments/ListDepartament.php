<?php

namespace App\Entities\Departaments;

use App\Entities\Entity;

class ListDepartament extends Entity
{
    protected $table = 'list_departaments';
    protected $fillable = ['name','token'];


    public static function listsLabel()
    {
        $members = self::all();
        $lists = [];
        foreach ($members AS $member)
        {
            array_push($lists, ['label' =>  $member->name, 'value' => $member->id]);
        }

        return $lists;
    }
}
