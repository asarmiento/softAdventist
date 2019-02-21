<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 19/1/2019
 * Time: 08:09:PM
 */

namespace App\Http\Controllers;


use App\Entities\Departaments\Club;
use App\Entities\Departaments\ClubCard;
use App\Entities\Departaments\ClubDirector;
use App\Entities\Departaments\MemberClub;
use App\Entities\Departaments\MemberClubByClubCard;
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
        $directors = ClubDirector::with('member','club','church')->where('year',Carbon::now()->year)->get();
        return response()->json(['success' => true,"directors"=>$directors], 200);
    }

    public function storeMemberCard(Request $request)
    {
        $data = $request->all();
        $member = $data['member'];
        $church = userChurch()->id;
        $codeGm = null;
        $codeLj= null;
        $dir=NULL;
        if(MemberClub::where('member_id',$member['value'])->count()>0) {
            MemberClub::where('member_id',$member['value'])->update(['church_id' => $church]);
            $id = $member['value'];
        }else{
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
            $id= $memberClub->id;
        }

        if($id) {

            if($data['cardA']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 1]);
            }
            if($data['cardC']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 2]);
            }
            if($data['cardE']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 3]);
            }
            if($data['cardO']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 4]);
            }
            if($data['cardV']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 5]);
            }
            if($data['cardG']) {
                MemberClubByClubCard::create(['member_club_id' => $id, 'club_card_id' => 6]);
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

        if(userChurch()) {
            $model = MemberClub::with('club')->
            where('church_id', userChurch()->id)->searchPaginateAndOrder($perPage, $request->get('search'));
        }else{
            $model = MemberClub::with('club')->whereHas('church',function ($q){
                $q->whereHas('district',function ($e){
                    $e->where('local_field_id', userCampo());
                });
            })->searchPaginateAndOrder($perPage, $request->get('search'));
        }
        $model->map(function ($e){
                $member = Member::find($e->member_id);
                $e->member = $member->name.' '.$member->last;
                $e->church = $member->church->name;
        });


        $array = $this->myPages($model);

        $columns = [];
        $model['per_page'] = $perPage;

        $response = [
            'model' => $model,
            'columns' => $columns,
            'my_pages' => $array
        ];
        return $response;
    }




}
