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

class ClubesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listProfile()
    {
        return view('clubes.ListProfile');
    }

    public function profile()
    {
        return view('clubes.profile');
    }

    public function registerClubDirector()
    {
        return view('clubes.registerClubDirector');
    }

    public function registerCards()
    {
        return view('clubes.registerCards');
    }

    public function registerSpecialties()
    {
        return view('clubes.registerSpecialties');
    }

    public function listDirector()
    {
        return ClubDirector::listsLabel();
    }
    public function listClubes()
    {
        return Club::listsLabel();
    }
}
