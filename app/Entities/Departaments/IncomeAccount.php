<?php

namespace App\Entities\Departaments;


use App\Entities\Entity;
use App\Entities\WeeklyIncome;
use App\Traits\DataViewerTraits;

class IncomeAccount extends Entity
{
    protected $table = 'income_accounts';
    protected $fillable = ['name','departament_id','balance','token','type'];
    public static $columns = [ 'name','balance','departaments' ];

    use DataViewerTraits;
    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-08-13
     * @Time       Create: 4:51pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description: Esta relacion en con la tabla departamentos a la que
     *             pertenece la cuenta.
     * @Pasos      :
     * ----------------------------------------------------------------------
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * ----------------------------------------------------------------------
     */
    public function departament()
    {
        return $this->belongsTo(Departament::getClass());
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-04
     * @TimeCreate: 10:57am
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     *
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * ----------------------------------------------------------------------
     * *
     */
    public function expensesAccounts()
    {
        return $this->hasMany(ExpenseAccount::getClass());
    }

    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-08-13
     * @Time       Create: 4:53pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     * ----------------------------------------------------------------------
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * ----------------------------------------------------------------------
     */
    public function weeklyIncomes()
    {
        return $this->hasMany(WeeklyIncome::getClass());
    }

    public function scopeSearch($query, $search){
        if(trim($search) != ""){
            $query->where("name","LIKE","%$search%")
                ->orWhere("balance","LIKE","%$search%");
        }

    }
}
