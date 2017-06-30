<?php

namespace App\Http\Controllers;

use App\Entities\IncomeAccount;
use App\Entities\TempIncomes;
use App\Http\Requests\TempIncomesRequest;
use Illuminate\Http\Request;

class TempIncomesController extends Controller
{
    //
    public function store(TempIncomesRequest $request)
    {
        $data = $request->all();
        //datos
        $account = IncomeAccount::where('token',$data['income_account_id'])->first();
        $data['income_account_id'] = $account->id;
        $data['user_id'] = currentUser()->id;
        //save
        $datos = new TempIncomes();
        $datos->fill($data);
        $datos->save();
        $datos = TempIncomes::with('incomeAccount')->find($datos->id);
        return response()->json(['success'=>true, 'message'=>['Se creo con Exito!!!!'],'account'=>$datos],200);
    }
    public function remove(Request $request)
    {
        $delete= TempIncomes::where('id',$request->get('id'))->delete();
        return response()->json(['success'=>true, 'message'=>[$delete]],200);
    }
}
