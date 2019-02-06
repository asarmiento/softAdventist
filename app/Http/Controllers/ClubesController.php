<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 19/1/2019
 * Time: 08:09:PM
 */

namespace App\Http\Controllers;


use App\Entities\Departaments\Club;
use App\Entities\Departaments\ClubDirector;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClubesController extends Controller
{
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
}
