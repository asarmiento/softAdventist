<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 12/07/2017
 * Time: 10:05 PM
 */

namespace App\Repositories;

use App\Entities\LocalFields\LocalField;

class LocalFiledRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
       return new LocalField(); // TODO: Implement getModel() method.
    }

    public function listSelectsSinFilterChurch()
    {
        $contents = [];
        foreach ($this->newQuery()->with('union.country')->get() AS $data):
            $value = ['value'=>$data->token, 'label'=>$data->name.' ('.$data->union->country->name.')'];
            array_push($contents,$value);
        endforeach;
        return $contents;
    }
}