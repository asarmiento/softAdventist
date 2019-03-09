<?php

namespace App\Entities\LocalFields;

use App\Entities\District;
use App\Entities\Entity;
use App\Entities\Union;

class LocalField extends Entity
{
    protected $table = 'local_fields';
    protected $fillable = ['name', 'email', 'token', 'union_id'];

    public function districts()
    {
        return $this->hasMany(District::getClass());
    }


    public function union()
    {
        return $this->belongsTo(Union::class);
    }

    public function whereUserBelongs()
    {
        return $this->hasMany(WhereUserBelong::class);
    }

    public static function listsLabel()
    {
        $unions = self::all();
        $lists = [];
        foreach ($unions AS $union) {
            array_push($lists, ['label' => $union->name, 'value' => $union->id]);
        }

        return $lists;
    }

    public function scopeSearch($query, $search){
        if(trim($search) != ""){
            $query->where("name","LIKE","%$search%")
                ->orWhere("phone","LIKE","%$search%");
        }

    }
}
