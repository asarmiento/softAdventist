<?php

namespace App\Entities\Departaments;


use App\Entities\Entity;
use App\Traits\DataViewerTraits;

class ExpenseAccount extends Entity
{
    protected $fillable = ['name', 'income_account_id', 'balance', 'token'];

    public static $columns = ['name', 'budget', 'percent_of_budget'];

    use DataViewerTraits;


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-08-13
     * @Time       Create: 8:30pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description: Relacion con la cuenta de ingreso que pertences el gasto
     * @Pasos      :
     * ----------------------------------------------------------------------
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * ----------------------------------------------------------------------
     */
    public function incomeAccount()
    {
        return $this->belongsTo(IncomeAccount::getClass());
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-08-13
     * @Time       Create: 8:31pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:Buscador para la tabla de cuentas de gastos o la relacion
     * @Pasos      :
     *
     * @param $query
     * @param $search
     * ----------------------------------------------------------------------
     * ----------------------------------------------------------------------
     */
    public function scopeSearch($query, $search)
    {
        if (trim($search) != "") {
            $query->whereHas("incomeAccount", function ($q) use ($search) {
                $q->where("name", "LIKE", "%$search%");
            })->orWhere("name", "LIKE", "%$search%")
                ->orWhere("balance", "LIKE", "%$search%");
        }

    }
}
