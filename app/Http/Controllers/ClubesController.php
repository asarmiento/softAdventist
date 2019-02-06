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

        $memberClub = new MemberClub();
            $memberClub->member_id=$member['value'];
        $memberClub->date=Carbon::now()->toDateString();
        $memberClub->code_gm=$codeGm;
        $memberClub->code_lj=$codeLj;
        $memberClub->status=false;
        $memberClub->club_director_id=$dir ;
        $memberClub->church_id=$church;
        $memberClub->user_id= Auth::user()->id;

        if($memberClub->save()) {
            if($data['cardA']) {
                MemberClubByClubCard::create(['member_club_id' => $memberClub->id, 'club_card_id' => 3]);
            }
            if($data['cardGm']) {
                MemberClubByClubCard::create(['member_club_id' => $memberClub->id, 'club_card_id' => 4]);
            }
            $memberClub = [];
            return response()->json(['success' => true, "miembros" => $memberClub], 200);
        }
    }

    public function getDataMemberClub(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        $model = MemberClub::with('member','club','church')->
        where('church_id', userChurch()->id)->searchPaginateAndOrder($perPage, $request->get('search'));

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
