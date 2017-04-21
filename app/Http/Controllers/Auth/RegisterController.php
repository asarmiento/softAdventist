<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
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
                $e->to($user->email,$user->name)->subject('Activa tu Cuenta de JA!');
        });

        Mail::send('auth/activation',compact('user','urlActive'),function ($j) use ($user){
            $j->from('jaacscr@contadventista.org','Departamento de Jovenes ACSCR');
            $j->to('jaacscr@contadventista.org',$user->name)->subject('Activa tu Cuenta!');
        });
        return $user;

    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect()->route('login')->with('alert','Por favor confirma tu email: '.$user->email);
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-04-20
     * @Time       Create: 4:52 pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     *
     * @param $token
     * ----------------------------------------------------------------------
     *
     * @return \Illuminate\Http\RedirectResponse
     * ----------------------------------------------------------------------
     */
    public function confirmation($token)
    {
        $user = User::where('registration_token',$token)->firstOrFail();
        $user->registration_token= null;
        $user->save();
        return redirect()->route('login')->with('alert','Email confirmado, puede Iniciar Sesión!');
    }
}
