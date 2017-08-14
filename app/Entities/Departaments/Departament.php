<?php

namespace App\Entities\Departaments;


use App\Entities\Entity;
use App\Traits\DataViewerTraits;

class Departament extends Entity
{
    protected $fillable = ['name','budget','balance','token','church_id','percent_of_budget'];
    public static $columns = [ 'name','budget','percent_of_budget' ];

    use DataViewerTraits;

    public function scopeSearch($query, $search){
        if(trim($search) != ""){
            $query->where("name","LIKE","%$search%")
                ->orWhere("budget","LIKE","%$search%")
                ->orWhere("percent_of_budget","LIKE","%$search%");
        }

    }
}
