<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 16/07/2017
 * Time: 03:34 PM
 */

namespace App\Repositories;

use App\Entities\Check;

class CheckRepository extends BaseRepository
{

    /**
     * @return mixed
     */
    public function getModel()
    {
        return new Check();// TODO: Implement getModel() method.
    }


    public function listCheks()
    {
        return $this->newQuery()->whereHas('bank', function ($q) {
            $q->where('church_id', userChurch()->id);
        })->with('checkExpenses')->with('bank')->get();
    }


    public function listRelationSelects($relation)
    {
        $contents = [];
        foreach ($this->filterChurchRelation($relation) AS $data):
            if($data->status =='no aplicado' && $data->type == 'local_field') {
                $value = [
                    'value' => $data->token,
                    'label' => 'Beneficiario: '.$data->name.' #'.$data->number.' Monto: '.$data->balance
                ];
                array_push($contents, $value);
            }
        endforeach;

        return $contents;
    }


    public function changeStatus($ck)
    {
        return $this->newQuery()->where('id', $ck)->update([ 'status' => 'aplicado' ]);
    }
}