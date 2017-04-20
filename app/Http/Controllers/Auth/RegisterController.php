<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'identification_card' => 'required|max:255',
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'identification_card' => $data['identification_card'],
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $user->status = 'inactivo';
        $user->registration_token = str_random(40);
        $user->save();

         $url = route('confirmation',['token'=>$user->registration_token]);
         $urlActive = route('activation',['email'=>$user->registration_token]);

        Mail::send('auth/registration',compact('user','url'),function ($e) use ($user){
                $e->from('jaacscr@contadventista.org','Departamento de Jovenes ACSCR');
                $e->subject('Activa tu Cuenta de JA!');
                $e->to($user->email,$user->name);
        });

        Mail::send('auth/activation',compact('user','urlActive'),function ($e) use ($user){
            $e->from('jaacscr@contadventista.org','Departamento de Jovenes ACSCR');
            $e->subject('Activa tu Cuenta!');
            $e->to('jaacscr@contadventista.org',$user->name);
        });
        return $user;

    }
}
