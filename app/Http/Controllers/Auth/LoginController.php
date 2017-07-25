<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Church;
use App\Entities\Member;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

   // protected $redirectTo = '/tesoreria/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function credentials($request)
    {

        $church=Church::find(Member::where('email',$request->get('email'))->first()->church_id);
        churchSession($church);
        return [
                'email'=>$request->get('email'),
                'password'=>$request->get('password'),
                'status'=>'activo'
        ];
    }


}
