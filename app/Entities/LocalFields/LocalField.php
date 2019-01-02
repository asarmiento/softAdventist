<?php

namespace App\Entities\LocalFields;

use App\Entities\Church;
use App\Entities\District;
use App\Entities\Entity;
use App\Entities\Union;
use Illuminate\Database\Eloquent\Model;

class LocalField extends Entity
{
    protected $table = 'local_fields';
    protected $fillable = ['name','email','token','union_id'];

    public function  districts()
    {
        return $this->hasMany(District::getClass());
    }


    public function union()
    {
        return $this->belongsTo(Union::class);
    }

    public static function listsLabel()
    {
        $unions = self::all();
        $lists = [];
        foreach ($unions AS $union)
        {
            array_push($lists, ['label' =>  $union->name, 'value' => $union->id]);
        }

        return $lists;
    }
}
