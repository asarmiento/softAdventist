<?php

namespace App\Entities\Departaments;

use App\Entities\Entity;
use App\Traits\DataViewerTraits;

/**
 * Class Departament
 * @package App\Entities\Departaments
 */
class Departament extends Entity
{

    protected $fillable = [ 'list_departament_id', 'budget', 'balance', 'token', 'church_id', 'percent_of_budget' ];

    public static $columns = [ 'list_departament_id', 'budget', 'percent_of_budget' ];

    use DataViewerTraits;

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-08-30
     * @TimeCreate: 11:24am
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     *
     * ${TYPE_NAME}
     * ----------------------------------------------------------------------
     *  * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * ----------------------------------------------------------------------
     * *
     */
    public function listDepartament()
    {
        return $this->belongsTo(ListDepartament::class);
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-08-30
     * @TimeCreate: 11:24am
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     *
     * ${TYPE_NAME}
     * ----------------------------------------------------------------------
     *  * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * ----------------------------------------------------------------------
     * *
     */
    public function incomeAccounts()
    {
        return $this->hasMany(IncomeAccount::getClass());
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-08-30
     * @TimeCreate: 11:24am
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     * @param $query
     * @param $search
     * ----------------------------------------------------------------------
     * *
     */
    public function scopeSearch($query, $search)
    {
        if (trim($search) != "") {
            $query->whereHas('listDepartament',function ($q) use($search){
                $q->where("name", "LIKE", "%$search%");
            })->orWhere("budget", "LIKE",
                "%$search%")->orWhere("percent_of_budget", "LIKE", "%$search%");
        }

    }
}
