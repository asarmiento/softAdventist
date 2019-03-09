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
        $data['password'] = bcrypt($data['name']);
        $user = new User();
        $user->fill($data);
        if($user->save()){
            return response()->json(['success'=>true],200);
        }

    }

    public function userData()
    {
        return currentUser();
    }
}
