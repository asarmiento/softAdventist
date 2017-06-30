<?php

namespace App\Http\Controllers;

use App\Entities\LocalFieldIncomeAccount;
use App\Entities\TempLocalFieldIncome;
use App\Http\Requests\CreateTempLocalFieldIncomeRequest;
use Illuminate\Http\Request;
use Psy\Exception\RuntimeException;

class TempLocalFieldIncomeController extends Controller
{
    public function store(CreateTempLocalFieldIncomeRequest $request)
    {
        $data = $request->all();
        //datos
        $account = LocalFieldIncomeAccount::where('token',$data['local_field_income_account_id'])->first();
        $data['local_field_income_account_id'] = $account->id;
        $data['user_id'] = currentUser()->id;
        //save
        $datos = new TempLocalFieldIncome();
        $datos->fill($data);
        $datos->save();
        $datos = TempLocalFieldIncome::with('localFieldIncomeAccount')->find($datos->id);
          return response()->json(['success'=>true, 'message'=>['Se creo con Exito!!!!'],'account'=>$datos],200);
    }

    public function remove(Request $request)
    {
       $delete= TempLocalFieldIncome::where('id',$request->get('id'))->delete();
        return response()->json(['success'=>true, 'message'=>[$delete]],200);
    }
}
