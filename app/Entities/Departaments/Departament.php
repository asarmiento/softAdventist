<?php

namespace App\Entities\Departaments;

use App\Entities\Entity;
use App\Traits\DataViewerTraits;

class Departament extends Entity
{

    protected $fillable = [ 'list_departament_id', 'budget', 'balance', 'token', 'church_id', 'percent_of_budget' ];

    public static $columns = [ 'list_departament_id', 'budget', 'percent_of_budget' ];

    use DataViewerTraits;

    public function listDepartament()
    {
        return $this->belongsTo(ListDepartament::getClass());
    }


    public function scopeSearch($query, $search)
    {
        if (trim($search) != "") {
            $query->where("name", "LIKE", "%$search%")->orWhere("budget", "LIKE",
                    "%$search%")->orWhere("percent_of_budget", "LIKE", "%$search%");
        }

    }
}
