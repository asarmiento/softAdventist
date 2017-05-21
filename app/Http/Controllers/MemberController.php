<?php

namespace App\Http\Controllers;

use App\Entities\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
     return view('members.index',compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }
}
