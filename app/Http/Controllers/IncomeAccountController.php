<?php

namespace App\Http\Controllers;

use App\Entities\Departament;
use App\Entities\ExpenseAccount;
use App\Entities\IncomeAccount;
use App\Http\Requests\IncomeAccountCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class IncomeAccountController extends Controller
{
    //

    public function create()
    {
        $contents = [];
        $departaments = Departament::where('church_id',1)->get();
        foreach ($departaments AS $departament):
            $value = ['value'=>$departament->token, 'label'=>$departament->name];
        array_push($contents,$value);
        endforeach;

        return view('departament.accounts.createIncome',compact('contents'));
    }

    public function store(IncomeAccountCreateRequest $request)
    {
        $data = $request->all();
        $departament = Departament::where('token',$data['departament_id']['value'])->first();
        $name = $data['name'];
        $data['name'] = 'Ing-'.$name;
        if($data['checkedNames'] == true):
            $data['type']='fix';
        endif;

        if(IncomeAccount::where('name',$data['name'])->where('departament_id',$departament->id)->count() > 0 ):
            return response()->json(['name'=>['Ya existe ese nombre con ese Departamento']],500);
        endif;
        $data['balance'] = '0';
        $data['token'] = Crypt::encrypt(substr($data['name'],0,60));
        $data['departament_id'] = $departament->id;

        $incomeAccount = new IncomeAccount();
        $incomeAccount->fill($data);
        if($incomeAccount->save()):
            $data['name'] = 'Gto-'.$name;
            $data['income_account_id'] = $incomeAccount->id;
            $expenseAccount = new ExpenseAccount();
            $expenseAccount->fill($data);
            if($expenseAccount->save())
                return response()->json(['success'=>true, 'message'=>'Se creo con Exito!!!!'],200);
        endif;


    }
}
