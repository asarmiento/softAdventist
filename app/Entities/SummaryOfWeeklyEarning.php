<?php

namespace App\Entities;


class SummaryOfWeeklyEarning extends Entity
{
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


    public function internal_control()
    {
        return $this->belongsTo(InternalControl::getClass());
    }


    public function depositLocalFields()
    {
        return $this->belongsToMany(LocalFieldDeposit::getClass(), 'l_f_deposit_s_of_w_earnings','summary_id')->withPivot('balance',
            'user_id')->withTimestamps();
    }
}
