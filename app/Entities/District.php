<?php

namespace App\Entities;


class District extends Entity
{
    //
    public function churchs()
    {
        return $this->hasMany(Church::class);
    }
}
