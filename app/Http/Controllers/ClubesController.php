<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 19/1/2019
 * Time: 08:09:PM
 */

namespace App\Http\Controllers;


use App\Entities\Church;
use App\Entities\Departaments\Club;
use App\Entities\Departaments\ClubCard;
use App\Entities\Departaments\ClubDirector;
use App\Entities\Departaments\MemberClub;
use App\Entities\Departaments\MemberClubByClubCard;
use App\Entities\Departaments\MemberSpeciality;
use App\Entities\Departaments\Specialties;
use App\Entities\LocalFields\LocalField;
use App\Entities\Member;
use App\Traits\DataViewerTraits;
use App\Traits\ListInformMembersTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubesController extends Controller
{
    use ListInformMembersTraits;
    use DataViewerTraits;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listProfile()
    {
        return view('clubes.ListProfile');
    }

    public function listProfilePastor()
    {
        return view('clubes.ListProfilePastor');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {

        return view('clubes.profile');
    }

    public function profileSpecialty($id)
    {
        $specialities = MemberSpeciality::with('specialityData','church','instructor')->where('member_id',$id)->get();
        $member = Member::find($id);
        return view('clubes.profile',compact('specialities','member'));

    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registerClubDirector()
    {
        return view('clubes.registerClubDirector');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registerCards()
    {
        return view('clubes.registerCards');
    }

    public function registerCardsAventureros()
    {
        return view('clubes.registerCardsAventureros');
    }

    public function registerCardsGMLJ()
    {
        return view('clubes.registerCardsCampo');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registerSpecialties()
    {
        return view('clubes.registerSpecialties');
    }

    public function registerNewSpecialties()
    {
        return view('clubes.registerEspecialidades');
    }

    /**
     * @return array
     */
    public function listDirector()
    {
        return ClubDirector::listsLabel();
    }

    public function listClubCard()
    {
        return ClubCard::listsLabel();
    }

    public function listSpecialties()
    {
        return Specialties::listsLabel();
    }

    public function listInstructores()
    {
        return MemberClub::listsInstructorLabel();
    }

    /**
     * @return array
     */
    public function listClubes()
    {
        return Club::listsLabel();
    }

    public function storeDirector(Request $request)
    {
        $data = $request->all();
        $member = $data['member'];
        $club = $data['club'];
        $church = $data['church'];

        ClubDirector::create([
            'year' => Carbon::now()->year,
            'member_id' => $member['value'],
            'club_id' => $club['value'],
            'church_id' => $church['value'],
            'user_id' => Auth::user()->id
        ]);
        $directors = ClubDirector::with('member', 'club', 'church')->where('year', Carbon::now()->year)->get();
        return response()->json(['success' => true, "directors" => $directors], 200);
    }

    public function storeMemberCard(Request $request)
    {
        $data = $request->all();
        $member = $data['member'];
        $IdMember = Member::find($member['value']);

        $church = $IdMember->church_id;
        $member = $data['member'];
        $codeGm = null;
        $codeLj = null;
        $dir = NULL;
        $type_gm = false;
        if (MemberClub::where('member_id', $member['value'])->count() > 0) {
            MemberClub::where('member_id', $member['value'])->update(['church_id' => $church]);
            $memberClub = MemberClub::where('member_id', $member['value'])->first();
            $id = $memberClub->id;
        } else {
            $memberClub = new MemberClub();
            $memberClub->member_id = $member['value'];
            $memberClub->date = Carbon::now()->toDateString();
            $memberClub->code_gm = $codeGm;
            $memberClub->code_lj = $codeLj;
            $memberClub->status = false;
            $memberClub->club_director_id = $dir;
            $memberClub->type_gm = $type_gm;
            $memberClub->church_id = $church;
            $memberClub->user_id = Auth::user()->id;
            $memberClub->save();
            $id = $memberClub->id;
        }

        if ($id) {

            if ($data['cardA']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 1)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 1]);
                }
            }
            if ($data['cardC']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 2)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 2]);
                }
            }
            if ($data['cardE']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 3)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 3]);
                }
            }
            if ($data['cardO']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 4)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 4]);
                }
            }
            if ($data['cardV']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 5)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 5]);
                }
            }
            if ($data['cardG']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 6)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 6]);
                }
            }
            if ($data['cardMP']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 17)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 17]);
                }
            }
            if ($data['cardMO']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 18)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 18]);
                }
            }

            //$memberClub = [];
            return response()->json(['success' => true, "miembros" => $memberClub], 200);
        }

        return response()->json(['success' => false, "message" => $memberClub->errors], 401);
    }

    public function storeMemberCardAventureros(Request $request)
    {
        $data = $request->all();
        $member = $data['member'];
        $IdMember = Member::find($member['value']);

        $church = $IdMember->church_id;
        $codeGm = null;
        $codeLj = null;
        $dir = NULL;
        if (MemberClub::where('member_id', $member['value'])->count() > 0) {
            MemberClub::where('member_id', $member['value'])->update(['church_id' => $church]);
            $memberClub = MemberClub::where('member_id', $member['value'])->first();
            $id = $memberClub->id;
        } else {
            $memberClub = new MemberClub();
            $memberClub->member_id = $member['value'];
            $memberClub->date = Carbon::now()->toDateString();
            $memberClub->code_gm = $codeGm;
            $memberClub->code_lj = $codeLj;
            $memberClub->status = false;
            $memberClub->club_director_id = $dir;
            $memberClub->church_id = $church;
            $memberClub->user_id = Auth::user()->id;
            $memberClub->save();
            $id = $memberClub->id;
        }

        if ($id) {

            if ($data['cardA']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 7)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 7]);
                }
            }
            if ($data['cardC']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 8)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 8]);
                }
            }
            if ($data['cardE']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 9)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 9]);
                }
            }
            if ($data['cardO']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 10)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 10]);
                }
            }
            if ($data['cardV']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 11)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 11]);
                }
            }
            if ($data['cardG']) {
                if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 12)->first()) {
                    MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 12]);
                }
            }

            //$memberClub = [];
            return response()->json(['success' => true, "miembros" => $memberClub], 200);
        }

        return response()->json(['success' => false, "message" => $memberClub->errors], 401);
    }

    public function storeMemberCardGuiaLider(Request $request)
    {
        $data = $request->all();
        $member = $data['member'];
        $IdMember = Member::find($member['value']);

        $church = $IdMember->church_id;
        $codeGm = null;
        $codeLj = null;
        if ($data['cardC']) {

            $last = Member::find($member['value']);
            $explode = explode('-', $data['codelj']);
            $protocol = $explode[0];
            $conse = $explode[1];
            $letra = substr($conse, 1);
            $num = strlen($last->last);

            $codeLj = $protocol . '-' . ucfirst(substr($last->last, -($num), 1)) . $letra;


        }
        $type_gm = false;
        if ($data['cardA']) {
            if ($data['notCodeGm']) {
                $type_gm = true;
                $codeGm = $this->codeGuiaMayor();
            } else {
                $type_gm = false;
                $codeGm = $data['codeGm'];
            }
        }
        $dir = NULL;

        if (MemberClub::where('member_id', $member['value'])->count() > 0) {
            MemberClub::where('member_id', $member['value'])
                ->update([
                    'church_id' => $church,
                    'type_gm' => $type_gm,
                    'code_gm' => $codeGm,
                    'code_lj' => $codeLj,
                ]);


            $memberClub = MemberClub::where('member_id', $member['value'])->first();
            $id = $memberClub->id;
        } else {
            $memberClub = new MemberClub();
            $memberClub->member_id = $member['value'];
            $memberClub->date = Carbon::now()->toDateString();
            $memberClub->type_gm = $type_gm;
            $memberClub->code_gm = $codeGm;
            $memberClub->code_lj = $codeLj;
            $memberClub->status = false;
            $memberClub->club_director_id = $dir;
            $memberClub->church_id = $church;
            $memberClub->user_id = Auth::user()->id;
            $memberClub->save();
            $id = $memberClub->id;
        }


        if ($data['cardA']) {

            if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 13)->first()) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 13]);
            }

        }
        if ($data['cardC']) {
            if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 14)->first()) {

                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 14]);

            }
        }
        if ($data['cardO']) {
            if (!MemberClubByClubCard::where('member_club_id', $id)->where('club_card_id', 16)->first()) {

                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 16]);

            }
        }

        // $memberClub = [];
        return response()->json(['success' => true, "miembros" => $memberClub], 200);


        return response()->json(['success' => false, "message" => $memberClub->errors], 401);
    }

    public function storeSpeciality(Request $request)
    {
        $data = $request->all();
        if(!isset($data['member'])){
            return response()->json(['success' => false, "message" => 'El miembro es Obligatorio'], 401);
        }
        if(!isset($data['specialty'])){
            return response()->json(['success' => false, "message" => 'La Especialidad es Obligatorio'], 401);
        }
        $member = Member::find($data['member']['value']);
        if(!isset($data['member_in_club'])){
            $instructor = NULL;
        }else{
            $instructor = $data['member_in_club']['value'];
        }

        if(!isset($data['other_instructor'])){
            $otherInstructor = NULL;
        }else{
            $otherInstructor = $data['other_instructor'];
        }
         if(MemberSpeciality::where('member_id',$member->id)->where('specialty_id',$data['specialty']['value'])->count()>0){
            MemberSpeciality::where('member_id',$member->id)
                ->where('specialty_id',$data['specialty']['value'])
                ->update(['member_in_club_id'=>$instructor,
                    'other_instructor'=>$otherInstructor,'date'=>$data['date']]);
             return response()->json(['success' => true, "miembros" => 'Se Actualizo con Exito'], 200);
        }else{
            MemberSpeciality::create(['member_in_club_id'=>$instructor,
                    'other_instructor'=>$otherInstructor,'date'=>$data['date'],
                    'specialty_id'=>$data['specialty']['value'],
                    'member_id'=>$member->id,'church_id'=>$member->church_id,
                'user_id'=>Auth::user()->id,
                'status'=>true]);
             return response()->json(['success' => true, "miembros" => 'Se registro con Exito'], 200);
        }

        return response()->json(['success' => false, "message" => 'No se pudo Registrar '], 401);


    }
    /**
     * @param Request $request
     * @return array
     */
    public function getDataMemberClub(Request $request)
    {
        $perPage = 50;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        if (userChurch()) {
            $model = MemberClub::with('club')->whereHas('church', function ($w) {
                $w->where('id', '<>', 124);
            })->
            where('church_id', userChurch()->id)->searchPaginateAndOrder($perPage, $request->get('search'));
            $campo = false;

            $model->map(function ($e) {
                $member = Member::find($e->member_id);
                $e->member = $member->name . ' ' . $member->last;
                $e->church = $member->church->name;
            });

        } else {

            $model = Church::with('membersC.memberClub.club')->whereHas('district', function ($e) {
                $e->where('local_field_id', userCampo());
            })->whereHas('members.memberClub')->where('id', '<>', 124)->search($request->get('search'))->paginate($perPage);

            $campo = true;
        }


        $array = $this->myPages($model);

        $columns = [];
        $model['per_page'] = $perPage;

        $response = [
            'model' => $model,
            'columns' => $columns,
            'my_pages' => $array,
            'campo' => $campo
        ];
        return $response;
    }

    public function getDataPastoresClub(Request $request)
    {
        $perPage = 50;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        if (userChurch()) {
            $model = MemberClub::with('club')->whereHas('church', function ($w) {
                $w->where('id', 124);
            })->
            where('church_id', userChurch()->id)->searchPaginateAndOrder($perPage, $request->get('search'));
            $campo = false;

            $model->map(function ($e) {
                $member = Member::find($e->member_id);
                $e->member = $member->name . ' ' . $member->last;
                $e->church = $member->church->name;
            });

        } else {

            $model = Church::with('membersC.memberClub.club')->whereHas('district', function ($e) {
                $e->where('local_field_id', userCampo());
            })->whereHas('members.memberClub')->where('id', 124)->search($request->get('search'))->paginate($perPage);

            $campo = true;
        }


        $array = $this->myPages($model);

        $columns = [];
        $model['per_page'] = $perPage;

        $response = [
            'model' => $model,
            'columns' => $columns,
            'my_pages' => $array,
            'campo' => $campo
        ];
        return $response;
    }


    public function dataDirectores(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }


        $model = LocalField::with('whereUserBelongs.user', 'whereUserBelongs.church', 'whereUserBelongs.listDeparmaent')
            ->search($request->get('search'))->paginate($perPage);

        $campo = true;


        $array = $this->myPages($model);

        $columns = [];
        $model['per_page'] = $perPage;

        $response = [
            'model' => $model,
            'columns' => $columns,
            'my_pages' => $array,
            'campo' => $campo
        ];
        return $response;
    }

    public function codeLiderJuvenil()
    {
        $member = MemberClub::whereHas('church', function ($q) {
            $q->whereHas('district', function ($e) {
                $e->where('local_field_id', userCampo());
            });
        })->whereNotNull('code_lj')->count();
        $numero = $member + 1;
        $code = "C1LJ-00001";
        if ($numero < 10) {
            $code = "C1LJ-0000" . $numero;
        } elseif ($numero < 100) {
            $code = "C1LJ-000" . $numero;
        } elseif ($numero < 1000) {
            $code = "C1LJ-00" . $numero;
        }

        return $code;
    }

    public function codeGuiaMayor()
    {
        $member = MemberClub::whereHas('church', function ($q) {
            $q->whereHas('district', function ($e) {
                $e->where('local_field_id', userCampo());
            });
        })->whereNotNull('code_gm')->where('type_gm', true)->max('code_gm');

        $count = MemberClub::whereHas('church', function ($q) {
            $q->whereHas('district', function ($e) {
                $e->where('local_field_id', userCampo());
            });
        })->whereNotNull('code_gm')->where('type_gm', true)->count();
        $code = "C1GM-1617";

        if ($count > 0) {
            $numero = explode('-', $member);
            $code = "C1GM-" . (int)($numero[1] + 1);
        }

        return $code;
    }

    public function listFiles()
    {
        return view('clubes.registerEspecialidades');
    }


}
