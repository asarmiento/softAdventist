<?php

namespace App\Http\Controllers;

use App\Entities\Member;
use App\Entities\User;
use App\Http\Requests\CreateMemberRequest;
use App\Traits\ListInformMembersTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use function Sodium\randombytes_random16;
use Validator;

class MemberController extends Controller
{
    public function __construct() {
            $this->middleware('cont')->only('create','edit','store','listMemberInfo');
    }


    use ListInformMembersTraits;
    public function index()
    {
        return view('members.listsMembers');
    }

    public function getData()
    {
        $model =  Member::searchPaginateAndOrder();
        $columns = Member::$columns;

        return response()->json([
            'model'=>[
                'pagination' => [
                    'total' => $model->total(),
                    'per_page' => $model->perPage(),
                    'current_page' => $model->currentPage(),
                    'last_page' => $model->lastPage(),
                    'from' => $model->firstItem(),
                    'to' => $model->lastItem()
                ],
                'data' => $model
            ],
            'columns'=>$columns
        ]);

         response()->json($response);
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
           return $this->exito(trans('El Miembro: ').$member->nameComplete());
        endif;
        return $this->errores($member->errors);

    }

    public function listMemberInfo()
    {
        return response()->json($this->listEnvelopesCreate());
    }


}
