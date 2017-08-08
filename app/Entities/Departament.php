<?php

namespace App\Entities;


use App\Traits\DataViewerTraits;

class Departament extends Entity
{
    protected $fillable = ['name','budget','token','church_id','percent_of_budget'];
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
