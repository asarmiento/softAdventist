<?php

namespace App\Http\Controllers;

use App\Entities\Member;
use App\Http\Requests\CreateMemberRequest;
use Illuminate\Http\Request;
use Validator;

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

    public function store(CreateMemberRequest $request)
    {
        echo json_encode($request->all());
        die;
           /* $data = $this->convertionObjeto();
            $member = new Member();
            if(Validator::make($data,$member->getRules())):
            $member->fill($data);
            $member->save();

            return $this->exito('se guardo con exito el Miembro: '.$member->nameComplete());
            endif;

            return $this->errores($member->errors);*/

    }
}
