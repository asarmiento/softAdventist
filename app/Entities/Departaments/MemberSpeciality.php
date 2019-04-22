<?php


namespace App\Entities\Departaments;


use App\Entities\Entity;

class MemberSpeciality extends Entity
{
    protected $table = 'specialities_of_members';

    protected $fillable = [ 'date', 'status', 'other_instructor', 'member_id', 'member_in_club_id', 'church_id', 'specialty_id', 'user_id'];
}
