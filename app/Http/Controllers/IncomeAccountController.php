<?php

namespace App\Http\Controllers;

use App\Entities\Departament;
use App\Http\Requests\IncomeAccountCreateRequest;
use Illuminate\Http\Request;

class IncomeAccountController extends Controller
{
    //

    public function create()
    {
        $departaments = Departament::where('church_id',1)->get();
        return view('departament.accounts.createIncome',compact('departaments'));
    }

    public function store(IncomeAccountCreateRequest $request)
    {

    }
}
