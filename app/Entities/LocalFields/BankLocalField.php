<?php

namespace App\Entities\LocalFields;


use App\Entities\Entity;

class BankLocalField extends Entity
{

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
