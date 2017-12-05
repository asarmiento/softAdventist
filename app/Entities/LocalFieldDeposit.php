<?php

namespace App\Entities;

use App\Entities\LocalFields\BankLocalField;
use Illuminate\Database\Eloquent\Model;

class LocalFieldDeposit extends Entity
{
    protected $fillable = ['number','date','balance','token','user_id','bank_local_field_id','image'];
    
    public function bank(){
    	return $this->belongsTo(BankLocalField::class);
    }
}
