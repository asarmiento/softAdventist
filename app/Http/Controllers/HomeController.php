<?php

namespace App\Http\Controllers;

use App\Entities\Retirement;
use App\Entities\YoungBoy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $youngBoy = new YoungBoy();
        return view('home',compact('youngBoy'));
    }



    public function store(Request $request)
    {
         $data = $request->all();

        $youngBoy = new YoungBoy();
        $data['code'] =1;
        $data['user_id'] =currentUser()->id;
        $data['date'] =Carbon::now()->format('Y-m-d');

        if($youngBoy->first()):
            $data['code'] = $youngBoy->first()->code + 1;
        endif;

        if($youngBoy->isValid($data)):
            $youngBoy->fill($data);
            $youngBoy->save();
            $data['young_boy_id'] =$youngBoy->id;
            $retirement =  new Retirement();
            if($retirement->isValid($data)):
                $retirement->fill($data);
                $retirement->save();
                Mail::send('youngBoys/emailInscription',compact('data'),function ($e) use ($data){
                    $e->from('jaacscr@contadventista.org','Departamento de Jovenes ACSCR');
                    $e->to(currentUser()->email,currentUser()->nameComplete())->subject('Inscripcion Retiro!');
                });
                return redirect()->route('create-inscription')->with('alert', 'Se Registro Con exito');
            endif;
        endif;
        return redirect()->back()->with('error', 'Tenemos un error')->withInput();
    }

}
