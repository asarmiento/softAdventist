<?php

namespace App\Entities\LocalFields;

use App\Entities\Church;
use App\Entities\District;
use App\Entities\Entity;
use Illuminate\Database\Eloquent\Model;

class LocalField extends Entity
{
    //

    public function  districts()
    {
        return $this->hasMany(District::getClass());
    }
}
