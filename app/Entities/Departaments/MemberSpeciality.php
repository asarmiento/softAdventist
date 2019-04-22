<?php


namespace App\Entities\Departaments;


use App\Entities\Church;
use App\Entities\Entity;
use App\Entities\Member;

class MemberSpeciality extends Entity
{
    protected $table = 'specialities_of_members';

    protected $fillable = ['date', 'status', 'other_instructor', 'member_id', 'member_in_club_id', 'church_id', 'specialty_id', 'user_id'];


    public function specialityData()
    {
        return $this->belongsTo(Specialties::class,'specialty_id','id');
    }

    public function church()
    {
        return $this->belongsTo(Church::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Member::class,'member_in_club_id','id');
    }

}
