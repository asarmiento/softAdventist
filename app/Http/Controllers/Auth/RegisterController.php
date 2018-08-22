<?php

namespace App\Http\Controllers\Auth;

use App\Entities\Member;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    protected $redirectTo = '/registrado/inscription';

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
            'identification_card' => 'required|max:255|unique:users',
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'church_id' => 'required',
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
        try {

            DB::beginTransaction();
            $user = User::create([
                'identification_card' => $data['identification_card'],
                'name' => $data['name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'avatar' => $data['name'],
                'church_id' => $data['church_id'],
                'password' => bcrypt($data['password']),
            ]);
            $user = User::where('email', $data['email'])->first();


            $data['user_id'] = $user->id;
            $member = new Member();
            $member->charter = $data['identification_card'];
            $member->name = $data['name'];
            $member->last = $data['last_name'];
            $member->phone = '00';
            $member->bautizmoDate = Carbon::now()->toDateString();
            $member->birthdate = Carbon::now()->toDateString();
            $member->cell = '000';
            $member->email = $data['email'];
            $member->church_id = $data['church_id'];
            $member->token = md5($data['identification_card']);
            $member->user_id = $user->id;
            $member->fill($data);
            if ($member->save()):

                $user->status = 'inactivo';
                $token = str_random(40);
                $user->registration_token = $token;
                $user->save();
                $url = route('verificacion', $token);
                $urlActive = route('active', ['email' => $user->registration_token]);

                Mail::send('auth/verification', compact('user', 'url'), function ($e) use ($user) {
                    $e->from('registro@jovenesadventistascr.com', 'Soporte SACR');
                    $e->to($user->email, $user->name)->subject('Verifica tu Email!');
                });

                Mail::send('auth/registration', compact('user', 'url'), function ($j) use ($user) {
                    $j->from('registro@jovenesadventistascr.com', 'Departamento de Jovenes ACSCR');
                    $j->to('registro@jovenesadventistascr.com', $user->name)->subject('Activa tu Cuenta!');
                });
                DB::commit();
                return $this->exito('se guardo con Exito...');
            endif;

            DB::rollback();
        }catch (\Exception $e){
            DB::rollback();
            return $this->errores('Errror en campos '.$e->getLine().' '.$e->getMessage());
        }

    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        if ($user['success']) {

        return redirect('/');
    }else{
            echo json_encode($user);
            die;
        return redirect()->back()->with('alert',$user);
    }
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
        $user = User::where('registration_token',$token)->first();
        if($user):
        $user->registration_token= null;
        $user->save();
        endif;
        return redirect()->route('login')->with('alert','Email confirmado, puede Iniciar Sesión!');
    }

    public function verificacion($token)
    {
        $user = User::where('registration_token',$token)->first();
        if($user):
        $user->status = 'activo';
        $user->registration_token= null;

        $user->save();
            Mail::send('auth/Acept',compact('data'),function ($e) use ($user){
                $e->from('registro@jovenesadventistascr.com', 'Departamento de Jovenes ACSCR');
                $e->to($user->email,$user->name)->subject('Verifica tu Email!');
            });
        endif;
        return redirect('/ja');
    }

    public function contact()
    {
        return view('auth.contact');
    }

    public function contactPost(Request $request)
    {
        $data = $request->all();

        Mail::send('auth/contacto',compact('data'),function ($e) use ($data){
            $e->from($data['email'],$data['name']);
            $e->to('info@contadventista.org','Soporte SACR')->subject('Verifica tu Email!');
         });
        Mail::send('auth/contactoUser',compact('data'),function ($e) use ($data){
            $e->from('no-reply@sistemasamigables.com','SACR');
            $e->to($data['email'],$data['name'])->subject('Confirmación de Recibido');
        });
        return redirect()->route('login')->with('alert','Se ha enviado correctamente, pronto te responderemos ');

    }
}
