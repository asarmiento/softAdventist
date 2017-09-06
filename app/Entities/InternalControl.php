<?php

namespace App\Entities;

use App\Traits\DataViewerTraits;

/**
 * Class InternalControl
 * @package App\Entities
 */
class InternalControl extends Entity
{
    protected $table = 'internal_controls';
    protected $primaryKey = 'id';
    protected $fillable = [
        'number',
        'balance',
        'number_of_envelopes',
        'saturday',
        'token',
        'church_id',
        'image'
    ];

    use DataViewerTraits;

    public static $columns = [ 'number',
        'balance',
        'number_of_envelopes',
        'saturday',
        'token',
        'church_id',
        'image' ];

    public function localFieldIncomeAccounts()
    {
        return $this->belongsToMany(LocalFieldIncomeAccount::getClass(),
            'local_field_incomes')->withPivot('envelope_number', 'balance', 'status');
    }


    public function churchDeposit()
    {
        return $this->belongsToMany(ChurchDeposit::getClass())->withPivot('balance', 'user_id')->withTimestamps();
    }


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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * ----------------------------------------------------------------------
     */
    public function summaryOfWeeklyEarning()
    {
        return $this->hasOne(SummaryOfWeeklyEarning::getClass());
    }

    public function scopeSearch($query, $search){
        if(trim($search) != ""){
            $query->where("name","LIKE","%$search%")
                ->orWhere("last","LIKE","%$search%")
                ->orWhere("bautizmoDate","LIKE","%$search%")
                ->orWhere("birthdate","LIKE","%$search%")
                ->orWhere("phone","LIKE","%$search%")
                ->orWhere("email","LIKE","%$search%")
                ->orWhere("charter","LIKE","%$search%");
        }

    }
}
