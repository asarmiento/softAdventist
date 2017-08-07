<?php
namespace App\Http\Controllers\Church;

use App\Entities\Church;
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