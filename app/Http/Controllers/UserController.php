<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 28/12/2018
 * Time: 01:08:PM
 */

namespace App\Http\Controllers;


use App\Entities\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('auth.createUser');
    }

    public function labelSelect()
    {
        return User::listsLabel();
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if ($data['type_user']){
            $data['type_user'] = $data['type_user']['value'];
        }
        $data['avatar'] = "";
        $data['password'] = bcrypt(123456);
        $user = new User();
        $user->fill($data);
        if($user->save()){
            return response()->json(['success'=>true],200);
        }
        return response()->json(['success'=>false, 'message'=>$user->errors],401);
    }

    public function userData()
    {
        return currentUser();
    }

    public function updateClaveUser()
    {
        return view('auth.updateClaveUser');
    }

    public function update(Request $request)
    {
        $data = $request->all();
        if(empty($data['password'])){
            return response()->json(['success'=>true,'message'=>'No se permite Contraseña en Blanco'],401);
        }
        if(User::where('id',$data['usuario']['value'])->update(['password'=>bcrypt($data['password'])])){
            return response()->json(['success'=>true],200);
        }
        return response()->json(['success'=>false],401);
    }
}
