<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 04/08/2017
 * Time: 10:16 AM
 */

namespace App\Repositories;

use App\Entities\LocalFields\BankLocalField;

class BankLocalFieldRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
       return new BankLocalField(); // TODO: Implement getModel() method.
    }

    public function listRelationSelects($relation)
    {
        $contents = [];
        foreach ($this->filterChurchRelation($relation) AS $data):
            $value = ['value'=>$data->token, 'label'=>$data->name];
            array_push($contents,$value);
        endforeach;
        return $contents;
    }
    public function filterChurchRelation($relation)
    {
        return $this->newQuery()->whereHas($relation,function ($q){
            $q->whereHas('districts',function ($r){
                $r->whereHas('churchs',function ($w){
                    $w->where('id',userChurch()->id);
                });
            });
        })->get();
    }
}