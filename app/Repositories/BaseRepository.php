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

    public function sumEnvelope($envelope,$data)
    {
        return $this->newQuery()->where('envelope_number', $envelope)->sum($data);
    }
    public function sumInInfo($envelopes)
    {
        return $this->newQuery()->whereIn('envelope_number', $envelopes)->sum('balance');
    }
    public function getType($type)
    {
        return $this->newQuery()->where('type', $type)->get();
    }

}