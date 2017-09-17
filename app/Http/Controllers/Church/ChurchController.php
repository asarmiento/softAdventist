<?php
namespace App\Http\Controllers\Church;

use App\Entities\Church;
use App\Entities\Union;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function newChurch()
    {
        $unions = Union::with('localFields')->get();
        return view('church.create',compact('unions'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Church::create([]);
    }

    public function transfers()
    {
        return view('departament.accounts.TransferAccounts');
    }
}