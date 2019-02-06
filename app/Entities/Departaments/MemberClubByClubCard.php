<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 5/2/2019
 * Time: 10:13:PM
 */

namespace App\Entities\Departaments;


use App\Entities\Entity;

class MemberClubByClubCard extends Entity
{
    protected $table = 'member_club_by_club_cards';

    protected $fillable = ['member_club_id','club_card_id'];
    public $timestamps = true;

    public function member()
    {
        return $this->belongsTo(MemberClub::class);
    }
}
