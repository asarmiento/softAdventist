<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class LocalFieldDeposit extends Entity
{
    protected $fillable = ['number','date','balance','token','user_id','bank_local_field_id','image'];
}
