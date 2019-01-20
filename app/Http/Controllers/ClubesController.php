<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 19/1/2019
 * Time: 08:09:PM
 */

namespace App\Http\Controllers;


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
}
