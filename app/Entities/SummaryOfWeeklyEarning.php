<?php

namespace App\Entities;


use App\Traits\DataViewerTraits;

class SummaryOfWeeklyEarning extends Entity
{
    use DataViewerTraits;
    protected $table = 'summary_of_weekly_earnings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'number',
        'offering',
        'sixty',
        'forty',
        'tithes',
        'other_church',
        'other',
        'internal_control_id',
        'token'
    ];
  public static  $columns = [];

    public function internal_control()
    {
        return $this->belongsTo(InternalControl::getClass());
    }


    public function depositLocalFields()
    {
        return $this->belongsToMany(LocalFieldDeposit::getClass(), 'l_f_deposit_s_of_w_earnings','summary_id')->withPivot('balance',
            'user_id')->withTimestamps();
    }

    public function scopeSearch($query, $search){
        if(trim($search) != ""){
            $query->where("number","LIKE","%$search%")
                ->orWhere("offering","LIKE","%$search%")
                ->orWhere("sixty","LIKE","%$search%")
                ->orWhere("forty","LIKE","%$search%")
                ->orWhere("tithes","LIKE","%$search%")
                ->orWhere("other_church","LIKE","%$search%")
                ->orWhere("other","LIKE","%$search%");
        }

    }
}
