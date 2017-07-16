<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Bank extends Entity
{
    protected $fillable = ['code','name','initial_balance','balance','church_id','user_id','token'];
}
