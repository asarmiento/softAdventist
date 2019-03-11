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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return view('clubes.profile');
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
        $church = userChurch()->id;
        $codeGm = null;
        $codeLj = null;
        $dir = NULL;
        if (MemberClub::where('member_id', $member['value'])->count() > 0) {
            MemberClub::where('member_id', $member['value'])->update(['church_id' => $church]);
            $id = $member['value'];
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
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 1]);
            }
            if ($data['cardC']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 2]);
            }
            if ($data['cardE']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 3]);
            }
            if ($data['cardO']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 4]);
            }
            if ($data['cardV']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 5]);
            }
            if ($data['cardG']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 6]);
            }

            $memberClub = [];
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
            $id = $member['value'];
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
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 7]);
            }
            if ($data['cardC']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 8]);
            }
            if ($data['cardE']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 9]);
            }
            if ($data['cardO']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 10]);
            }
            if ($data['cardV']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 11]);
            }
            if ($data['cardG']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 12]);
            }

            $memberClub = [];
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
            $protocol = substr($data['codelj'],-5);
            $conse = substr($data['codelj'],5);
            $letra = substr($conse,1);
            $last = Member::find($member['value']);
            $num = strlen($last);
            $codeLj = $protocol.substr($last,-($num-1)).$letra;
        }
        if ($data['cardA']) {
            if($data['notCodeGm']) {
                $codeGm = $data['codeGm'];
            }else{
                $codeGm = $data['codeGm'];
            }
        }
        $dir = NULL;
        if (MemberClub::where('member_id', $member['value'])->count() > 0) {
            MemberClub::where('member_id', $member['value'])->update(['church_id' => $church]);
            $id = $member['value'];
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
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 13]);
            }
            if ($data['cardC']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 14]);
            }

            $memberClub = [];
            return response()->json(['success' => true, "miembros" => $memberClub], 200);
        }

        return response()->json(['success' => false, "message" => $memberClub->errors], 401);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getDataMemberClub(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        if (userChurch()) {
            $model = MemberClub::with('club')->
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
            })->whereHas('members.memberClub')->search($request->get('search'))->paginate($perPage);

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



            $model = LocalField::with('whereUserBelongs.user','whereUserBelongs.church','whereUserBelongs.listDeparmaent')
        ->search($request->get('search'))->paginate($perPage);

            $campo = true;

        echo json_encode($model);
        die;

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


}
