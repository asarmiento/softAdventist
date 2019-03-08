<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 04:58 PM
 */

namespace App\Entities;

use App\Entities\Departaments\MemberClub;
use App\Traits\DataViewerTraits;

class Member extends Entity
{
    protected $table = 'members';
    protected $timestamp;

    protected $fillable = [
        'charter',
        'name',
        'last',
        'bautizmoDate',
        'birthdate',
        'phone',
        'type',
        'cell',
        'civil_status',
        'address',
        'email',
        'church_id',
        'token',
        'user_id'
    ];

    use DataViewerTraits;

    public static $columns = ['charter', 'name', 'last', 'birthdate', 'phone', 'bautizmoDate', 'cell', 'email'];


    public function incomes()
    {
        return $this->belongsTo(Income::getClass(), 'id', 'member_id');
    }


    public function nameComplete()
    {
        return $this->name . '  ' . $this->last;
    }


    public function member($date)
    {
        return $this->belongsTo(Member::getClass(), 'member_id', 'id')->where('date', $date);
    }

    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function memberClub()
    {
        return $this->hasMany(MemberClub::class);
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
            'local_field_incomes', 'church_l_f_income_account')->withPivot('envelope_number', 'balance', 'status');
    }


    public function localFieldIncomes()
    {
        return $this->hasMany(LocalFieldIncome::getClass());
    }

    public static function listsLabel()
    {
        $members = self::where('church_id', userChurch()->id)->get();
        $lists = [];
        foreach ($members AS $member) {
            array_push($lists, ['label' => $member->name . ' ' . $member->last, 'value' => $member->id]);
        }

        return $lists;
    }

    public static function listsLabelCampo()
    {
        if (userCampo()) {
            $members = self::whereHas('church', function ($q) {
                $q->whereHas('district', function ($r) {
                    $r->where('local_field_id', userCampo());
                });
            })->get();
        } else {
            $members = self::whereHas('church', function ($q) {
                $q->whereHas('district', function ($r) {
                    $r->whereHas('localField', function ($e) {
                        $e->where('union_id', userUnion());
                    });
                });
            })->get();
        }
        $lists = [];
        foreach ($members AS $member) {
            array_push($lists, ['label' => $member->name . ' ' . $member->last, 'value' => $member->id]);
        }

        return $lists;
    }

    public function scopeSearch($query, $search)
    {
        if (trim($search) != "") {
            $query->where("name", "LIKE", "%$search%")
                ->orWhere("last", "LIKE", "%$search%")
                ->orWhere("bautizmoDate", "LIKE", "%$search%")
                ->orWhere("birthdate", "LIKE", "%$search%")
                ->orWhere("phone", "LIKE", "%$search%")
                ->orWhere("email", "LIKE", "%$search%")
                ->orWhere("charter", "LIKE", "%$search%");
        }

    }
}
