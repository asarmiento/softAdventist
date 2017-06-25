<?php

namespace App\Http\Controllers;

use App\Entities\InternalControl;
use App\Entities\Member;
use Illuminate\Http\Request;

class WeeklyIncomeController extends Controller
{
    //
    public function create($token)
    {

        $internalControl = InternalControl::where('token',$token)->first();
        $allMembers = Member::all();
        $members=[];
        foreach ($allMembers AS $member):
            array_push($members,['value'=>$member->token,'label'=>$member->nameComplete()]);
        endforeach;
        return view('IncomesAndExpenses.registerWeeklyIncomes',compact('internalControl','members'));
    }
}
