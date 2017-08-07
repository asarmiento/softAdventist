<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 11/07/2017
 * Time: 12:39 PM
 */

namespace App\Repositories;

abstract class BaseRepository {


    /**
     * @return mixed
     */
    abstract public function getModel();

    public function __construct(){

    }

    public function token($token) {
        $consults = $this->newQuery()->where('token', $token)->get();
        if ($consults):
            foreach ($consults as $consult):
                return $consult;
            endforeach;
        endif;

        return false;
    }

    public function newQuery() {
        return $this->getModel()->newQuery();
    }
    public function filterChurchs()
    {
        return $this->newQuery()->where('church_id',userChurch()->id)->get();
    }

    public function listSelects()
    {
        $contents = [];
        foreach ($this->filterChurchs() AS $data):
            $value = ['value'=>$data->token, 'label'=>$data->name];
            array_push($contents,$value);
        endforeach;
        return $contents;
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
            $q->where('church_id',userChurch()->id);
        })->get();
    }
    public function sumEnvelope($envelope,$data)
    {
        return $this->newQuery()->where('envelope_number', $envelope)->sum($data);
    }
    public function sumInInfo($envelopes)
    {
        return $this->newQuery()->whereIn('envelope_number', $envelopes)->sum('balance');
    }
    public function sumStatus($status)
    {
        return $this->newQuery()->where('status', $status)->sum('balance');
    }
    public function getType($type)
    {
        return $this->newQuery()->where('type', $type)->get();
    }

    public function find($id){
        return $this->newQuery()->find($id);
    }
}