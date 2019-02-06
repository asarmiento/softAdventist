<?php

namespace App\Entities;


use App\Entities\LocalFields\LocalField;

class District extends Entity
{
    protected $fillable = ['name', 'shepherd', 'token', 'local_field_id'];
    //
    public function churchs()
    {
        return $this->hasMany(Church::class);
    }

    public function localField()
    {
        return $this->belongsTo(LocalField::class);
    }
}
