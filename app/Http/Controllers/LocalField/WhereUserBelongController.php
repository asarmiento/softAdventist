<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 28/12/2018
 * Time: 12:24:PM
 */

namespace App\Http\Controllers\LocalField;


use App\Entities\LocalFields\WhereUserBelong;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WhereUserBelongController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('localField.CrearUserCargo');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $datos = [];

        if($data['church']==null)
        {
            $datos['church_id']=$data['church'];
        }else{
            $datos['church_id']=$data['church']['value'];
        }
        if($data['union']==null)
        {
            $datos['union_id']=$data['union'];
        }else{
            $datos['union_id']=$data['union']['value'];
        }
        if($data['local'] == null)
        {
            $datos['local_field_id']=$data['local'];
        }else{
            $datos['local_field_id']=$data['local']['value'];
        }
        if($data['cargo']==null)
        {
            $datos['cargo']=$data['cargo'];
        }else{
            $datos['cargo']=$data['cargo']['value'];
        }
        if($data['user']==null)
        {
            $datos['user_id']=$data['user'];
        }else{
            $datos['user_id']=$data['user']['value'];
        }



        $user = new WhereUserBelong();
        $user->fill($datos);
        $user->save();

        return response()->json(['success'=>true,'message'=>'Se guardo con Exito'],200);
    }
}
