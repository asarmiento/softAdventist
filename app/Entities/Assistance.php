<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 31/12/2018
 * Time: 09:57:AM
 */

namespace App\Entities;


class Assistance extends Entity
{
    protected $table = 'assists_members_and_visitor';
    
    protected $fillable = [ 'date', 'time', 'liturgia', 'member_id', 'visitor_id', 'user_id','pray_request','church_id'];


    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }
}
