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
use Yajra\Datatables\Datatables;

class MemberController extends Controller
{

    use ListInformMembersTraits;


    /**
     * MemberController constructor.
     */
    public function __construct()
    {
        $this->middleware('cont')->only('create', 'edit', 'store', 'listMemberInfo');
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: ${DATE}
     * @Time       Create: ${TIME}
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     * ----------------------------------------------------------------------
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * ----------------------------------------------------------------------
     */
    public function index()
    {
        return view('members.listsMembers');
    }


    public function getData(Request $request)
    {
        $model = Member::searchPaginateAndOrder(($request->get('all')) ? $request->get('all') : $request->get('perPage'),
            $request->get('search'));

        $columns = Member::$columns;
        $response = [
            'model' => $model,

            'columns' => $columns
        ];

        return $response;

        // response()->json($response);
    }


    public function create()
    {
        return view('members.create');
    }


    public function edit()
    {
        $member = Member::all();

        return view('members.create', compact('member'));
    }


    public function store(CreateMemberRequest $request)
    {
        $data = $request->all();
        $data = $this->CreacionArray($data, '');
        $user = User::where('email', $data['email'])->first();
        $data['church_id'] = 1;
        if (count($user) == 0):
            $user = User::create([
                'identification_card' => $data['charter'],
                'name'                => $data['name'],
                'last_name'           => $data['last'],
                'email'               => $data['email'],
                'status'              => 'activo',
                'token'               => str_random(40),
                'password'            => bcrypt(123456),
            ]);
        endif;

        $data['user_id'] = $user->id;
        $member = new Member();
        $member->fill($data);
        if ($member->save()):
            return $this->exito(trans('El Miembro: ').$member->nameComplete());
        endif;

        return $this->errores($member->errors);

    }


    public function listMemberInfo()
    {
        return response()->json($this->listEnvelopesCreate());
    }

}
