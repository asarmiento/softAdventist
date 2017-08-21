<?php

namespace App\Entities\Departaments;

use App\Entities\Entity;

class ListDepartament extends Entity
{
    protected $table = 'list_departaments';
    protected $fillable = ['name'];
}
