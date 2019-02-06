<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 5/2/2019
 * Time: 04:28:PM
 */

namespace App\Entities\Departaments;


use App\Entities\Church;
use App\Entities\Entity;
use App\Entities\Member;
use App\Traits\DataViewerTraits;

class MemberClub extends Entity
{
    protected $table='members_in_clubs';
    protected $fillable = ['code_gm', 'code_lj', 'date', 'status', 'member_id', 'club_director_id', 'church_id', 'user_id'];

    use DataViewerTraits;
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function club()
    {
        return $this->belongsToMany(ClubCard::class,'member_club_by_club_cards');
    }

    public function church()
    {
        return $this->belongsTo(Church::class);
    }
    public static function listsLabel()
    {
        $directors = self::whereHas('member',function ($q){
            $q->where('church_id',userChurch()->id);
        })->with('member')->get();
        $lists = [];
        foreach ($directors AS $director)
        {
            array_push($lists, ['label' =>  $director->member->name.' '.$director->member->last, 'value' => $director->id]);
        }

        return $lists;
    }

    public function scopeSearch($query, $search){
        if(trim($search) != ""){
            $query->where("code_gm","LIKE","%$search%")
                ->orWhere("code_lj","LIKE","%$search%")
                ->orWhere("date","LIKE","%$search%");
        }

    }
}
