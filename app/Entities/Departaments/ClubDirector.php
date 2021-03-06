<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 27/1/2019
 * Time: 02:27:AM
 */

namespace App\Entities\Departaments;


use App\Entities\Church;
use App\Entities\Entity;
use App\Entities\Member;

class ClubDirector extends Entity
{
    protected $table = 'club_directors';
    protected $fillable = [ 'year', 'member_id', 'club_id', 'church_id', 'user_id'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
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
}
