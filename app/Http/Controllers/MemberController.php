<?php

namespace App\Http\Controllers;

use App\Entities\Member;
use App\Entities\User;
use App\Http\Requests\CreateMemberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Validator;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::where('church_id',currentUser()->member->church_id)->get();
     return view('members.index',compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function edit()
    {
        $member = Member::all();
        return view('members.create',compact('member'));
    }

    public function store(CreateMemberRequest $request)
    {
        $data = $request->all();
        $data = $this->CreacionArray($data,'');
        $user = User::where('email',$data['email'])->first();
        $data['church_id']= 1;
        if(count($user)==0):
            $user = User::create([
                'identification_card' => $data['charter'],
                'name' => $data['name'],
                'last_name' => $data['last'],
                'email' => $data['email'],
                'status' => 'activo',
                'token' => str_random(40),
                'password' => bcrypt(123456),
            ]);
        endif;

        $data['user_id']= $user->id;
        $member = new Member();
        $member->fill($data);
        if($member->save()):
           return $this->exito('El Miembro: '.$member->nameComplete());
        endif;
        return $this->errores($member->errors);

    }
}
