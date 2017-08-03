<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 04:58 PM
 */

namespace App\Entities;

use App\Traits\DataViewerTraits;

class Member extends Entity
{

    protected $timestamp;

    protected $fillable = [
        'charter',
        'name',
        'last',
        'bautizmoDate',
        'birthdate',
        'phone',
        'cell',
        'email',
        'church_id',
        'token',
        'user_id'
    ];

    use DataViewerTraits;

    public static $columns = [ 'charter', 'name', 'last', 'birthdate', 'phone', 'cell', 'email' ];


    public function incomes()
    {
        return $this->belongsTo(Income::getClass(), 'id', 'member_id');
    }


    public function nameComplete()
    {
        return $this->name.'  '.$this->last;
    }


    public function member($date)
    {
        return $this->belongsTo(Member::getClass(), 'member_id', 'id')->where('date', $date);
    }


    public function weeklyIncomes()
    {
        return $this->hasMany(WeeklyIncome::getClass());
    }


    public function incomesAccounts()
    {
        return $this->belongsToMany(IncomeAccount::getClass(), 'weekly_incomes')->withPivot('envelope_number',
            'balance', 'status');
    }


    public function localIncomesAccounts()
    {
        return $this->belongsToMany(LocalFieldIncomeAccount::getClass(),
            'local_field_incomes')->withPivot('envelope_number', 'balance', 'status');
    }


    public function localFieldIncomes()
    {
        return $this->hasMany(LocalFieldIncome::getClass());
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
