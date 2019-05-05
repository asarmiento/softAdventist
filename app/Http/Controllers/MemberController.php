<?php

namespace App\Http\Controllers;

use App\Entities\Member;
use App\Entities\User;
use App\Http\Requests\CreateMemberRequest;
use App\Traits\DataViewerTraits;
use App\Traits\ListInformMembersTraits;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;
use Validator;

class MemberController extends Controller
{

    use ListInformMembersTraits;
    use DataViewerTraits;

    /**
     * MemberController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->only('create', 'edit', 'store', 'listMemberInfo');
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


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: ${DATE}
     * @Time       Create: ${TIME}
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     * @param Request $request
     * ----------------------------------------------------------------------
     *
     * @return array
     * ----------------------------------------------------------------------
     */
    public function getData(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }
        if (userChurch()) {
            $model = Member::where('church_id', userChurch()->id)->searchPaginateAndOrder($perPage, $request->get('search'));
        } else {
            $model = Member::whereHas('church', function ($q) {
                $q->whereHas('district', function ($e) {
                    $e->where('local_field_id', userCampo());
                });
            })->searchPaginateAndOrder($perPage, $request->get('search'));
        }
        $array = $this->myPages($model);

        $columns = Member::$columns;
        $model['per_page'] = $perPage;

        $response = [
            'model' => $model,
            'columns' => $columns,
            'my_pages' => $array
        ];
        return $response;
    }


    public function create()
    {
        return view('members.create');
    }


    public function edit($id)
    {
        $member = Member::find($id);

        return view('members.edit', compact('member'));
    }


    public function store(CreateMemberRequest $request)
    {
        $data = $request->all();
        $data = $this->CreacionArray($data, '');
        $user = User::where('email', $data['email'])->first();
        if (count($user) == 0):
            if (!empty($data['email'])) {
                $user = User::create([
                    'identification_card' => $data['charter'],
                    'name' => $data['name'],
                    'last_name' => $data['last'],
                    'email' => $data['email'],
                    'status' => 'activo',
                    'avatar' => '',
                    'token' => str_random(40),
                    'password' => bcrypt(123456),
                ]);
            }
        endif;

        if (is_array($data['civil_status'])) {
            $data['civil_status'] = $data['civil_status']['value'];
        }
        if (is_array($data['type'])) {
            if($data['type']['value'] == 'Adventista') {


                $data['type'] = true;
            }else{
                $data['type'] = false;
            }
        }else{
            return $this->errores('Debe seleccionar el estado del Miembro');
        }
        if($data['club']=="true"){
            $data['club'] = true;
        }else{
            $data['club'] = false;
        }
        $user = User::where('email', currentUser()->email)->first();
        if (!$data['church']) {
            $data['church_id'] = userChurch()->id;
        } else {
            $data['church_id'] = $data['church']['value'];
        }
        $data['user_id'] = $user->id;
        $member = new Member();
        $member->fill($data);
        if ($member->save()):
            return $this->exito(trans('El Miembro: ') . $member->nameComplete());
        endif;

        return $this->errores($member->errors);

    }

    public function update(Request $request)
    {
        $data = $request->all();
        $data = $this->CreacionArray($data, '');


        if (is_array($data['civil_status'])) {
            $data['civil_status'] = $data['civil_status']['value'];
        }
        if (is_numeric($data['church'])) {
            $data['church_id'] = $data['church'];
        } else {
            $data['church_id'] = $data['church']['value'];
        }
        if($data['club']=="true"){
            $data['club'] = true;
        }else{
            $data['club'] = false;
        }


        $member = Member::find($data['id']);
        $member->fill($data);
        if ($member->save()):
            return $this->exito(trans('El Miembro: ') . $member->nameComplete());
        endif;

        return $this->errores($member->errors);
    }

    public function listMemberInfo($date)
    {
        return response()->json($this->listEnvelopesCreate($date));
    }

    public function registerMemMatEscSab()
    {
        return view('members.RegistroMemMatEscSab');
    }

    public function selectMembers()
    {
        if (userCampo() > 0) {
            return Member::listsLabelCampo();
        }else{
        return Member::listsLabel();
    }
    }

    public function selectMembersCampo()
    {

        return Member::listsLabelCampo();
    }

    public function assistance()
    {
        return view('members.assistance');
    }
}
