<?php
namespace App\Http\Controllers\Church;

use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 05:03 PM
 */
class ChurchController extends Controller
{

    public function create()
    {
        return view('church.create');
    }
}