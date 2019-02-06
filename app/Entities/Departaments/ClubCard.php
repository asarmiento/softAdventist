<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 5/2/2019
 * Time: 08:05:PM
 */

namespace App\Entities\Departaments;


use App\Entities\Entity;

class ClubCard extends Entity
{
    protected $table ="club_cards";

    protected $fillable = ['name', 'age', 'description', 'url_card', 'url_book', 'local_field_id', 'club_id'];

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
