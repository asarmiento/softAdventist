<?php

namespace App\Entities\LocalFields;


use App\Entities\Entity;

class BankLocalField extends Entity
{
	protected $fillable = ['code','name','balance','token','local_field_id','user_id'];
    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: ${DATE}
     * @Time       Create: ${TIME}
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     * ----------------------------------------------------------------------
     * @return mixed
     * ----------------------------------------------------------------------
     */
    public function localField()
    {
        return $this->belongsTo(LocalField::class);
    }
}
