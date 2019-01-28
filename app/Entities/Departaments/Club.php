<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 27/1/2019
 * Time: 02:57:AM
 */

namespace App\Entities\Departaments;


use App\Entities\Entity;

class Club extends Entity
{
    protected $fillable = ['year', 'member_id', 'club_id', 'church_id', 'user_id'];

    public static function listsLabel()
    {
        $directors = self::all();
        $lists = [];
        foreach ($directors AS $director)
        {
            array_push($lists, ['label' =>  $director->name, 'value' => $director->id]);
        }

        return $lists;
    }
}
