<?php

namespace App\Http\Controllers;

use App\Entities\InternalControl;
use App\Http\Requests\InternalControlCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InternalControlController extends Controller
{
    //

    public function create()
    {
        return view('IncomesAndExpenses.createInternalControl');
    }

    public function store(InternalControlCreateRequest $request)
    {
        $data = $request->all();
        $data['token'] = Crypt::encrypt($data['number'].$data['saturday']);
        $data['church_id'] = 1;

        $iinternalControl = new InternalControl();
        $iinternalControl->fill($data);
        if($iinternalControl->save()):
                return response()->json(['success'=>true, 'message'=>'Se creo con Exito!!!!','token'=>$iinternalControl->token],200);
        endif;
        return response()->json($iinternalControl->errors,422);
    }
}
