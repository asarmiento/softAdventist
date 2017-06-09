<?php

namespace App\Http\Controllers;

use App\Entities\Retirement;
use App\Entities\User;
use App\Entities\YoungBoy;
use Carbon\Carbon;
use Codedge\Fpdf\Facades\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $year = Carbon::now();

        if($youngBoy->OrderBy('code','DESC')->first()==null):
            $code = $year->format('Y').'-1';
        else:
            $separar = explode('-',$youngBoy->orderBy('updated_at','DESC')->first()->code);
            $numeration = $separar[1] + 1;
            $code = $year->format('Y').'-'.$numeration;
        endif;
        $registros = Retirement::whereHas('youngBoy',function ($q){
            $q->where('user_id',currentUser()->id);
        })->get();
        $saldo = 38500;
       if( $youngBoy->where('user_id',currentUser()->id)->count() ==0):
            return view('home',compact('youngBoy','code','saldo','registros'));
       else:
           $youngBoy = $youngBoy->where('user_id',currentUser()->id)->first();
            $saldo = $saldo-$youngBoy->retirements()->sum('amount');
            return view('registered',compact('youngBoy','saldo','registros'));
       endif;
    }



    public function store(Request $request)
    {
         $data = $request->all();
        try {
            DB::beginTransaction();
            $youngBoy = new YoungBoy();
            $year = Carbon::now();
            $data['user_id'] = currentUser()->id;
            $data['date'] = Carbon::now()->format('Y-m-d');
            $date = explode('-',$data['birthdate']);
            $data['age'] =Carbon::createFromDate($date[0],$date[1],$date[2])->age;
            $buscando = YoungBoy::where('user_id',currentUser()->id)->count();
            if($youngBoy->orderBy('code','DESC')->first()):
            $separar = explode('-',$youngBoy->orderBy('updated_at','DESC')->first()->code);
            $numeration = $separar[1]+1;
            $code = $year->format('Y').'-'.$numeration;
            $data['code'] = $code;
            else:
                $data['code'] =1;
            endif;
            if($buscando>0):
                return redirect()->back()->with('error', 'Tenemos un error, Ya se Registro una vez');
            else:
                if ($youngBoy->isValid($data)):
                    $youngBoy->fill($data);
                    $youngBoy->save();
                    $data['young_boy_id'] = $youngBoy->id;
                    \Log::info(json_encode($youngBoy->count()));
                    if($youngBoy->count()>0):
                        $buscando = Retirement::where('young_boy_id',$youngBoy->id)->where('voucher',$data['voucher'])
                            ->count();
                        if($buscando>0):
                            DB::rollback();
                            return redirect()->back()->with('error', 'Tenemos un error, Ya existe ese Numero de Deposito');
                        else:
                            if($request->has('file')):
                                return redirect()->back()->with('error', 'La imagen del deposito es obligatoria');

                            endif;
                            $file = $request->file('file');
                            if($file):
                            //obtenemos el nombre del archivo
                            $nombre = currentUser()->email.'-'.$data['voucher'].'.'.$file->getClientOriginalExtension();
                            $data['file'] = $file->getClientOriginalExtension();
                            //indicamos que queremos guardar un nuevo archivo en el disco local
                            \Storage::disk('local')->put($nombre,  \File::get($file));
                            else:
                                DB::rollback();
                                return redirect()->back()->with('error', 'La imagen del deposito es obligatoria');
                            endif;
                            $retirement = new Retirement();
                            if ($retirement->isValid($data)):
                                $retirement->fill($data);
                                $retirement->save();
                                Mail::send('youngBoys/emailInscription', compact('data', 'youngBoy'), function ($e) use ($data) {
                                    $e->from('jaacscr@contadventista.org', 'Departamento de Jovenes ACSCR');
                                    $e->to(currentUser()->email, currentUser()->nameComplete())->subject('Inscripcion Retiro!');
                                });
                                DB::commit();
                                return redirect()->route('home')->with('alert', 'Se Registro Con exito');
                            endif;
                        endif;
                        DB::rollback();
                        return redirect()->back()->with('error', 'Tenemos un error')->withInput($request->input())
                            ->withErrors($retirement->errors, $this->errorBag());
                    endif;
                endif;
            endif;
            DB::rollback();
            return redirect()->back()->with('error', 'Tenemos un error')->withInput($request->input())
                ->withErrors($youngBoy->errors, $this->errorBag());
        }catch (Exception $e) {
            \Log::error($e);
            return redirect()->back()->with('error', 'Verificar la información del asiento, sino contactarse con soporte de la applicación');
        }
    }

    public function registered(Request $request)
    {
        $data = $request->all();
        $data['young_boy_id'] =currentUser()->youngBoy->id;
        $data['date'] =Carbon::now()->format('Y-m-d');
        $data['shirt_size'] =currentUser()->youngBoy->retirements[0]->shirt_size;
        $buscando = Retirement::where('young_boy_id',currentUser()->youngBoy->id)->where('voucher',$data['voucher'])
            ->count();
        if($buscando>0):
            return redirect()->back()->with('error', 'Tenemos un error, Ya existe ese Numero de Deposito');
        else:
            if(!$request->file('file')):
                return redirect()->back()->with('error', 'La imagen del deposito es obligatoria');

            endif;
            $file = $request->file('file');
            //obtenemos el nombre del archivo
            $nombre = currentUser()->email.'-'.$data['voucher'].'.'.$file->getClientOriginalExtension();
            $data['file'] = $file->getClientOriginalExtension();
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre,  \File::get($file));

            $retirement =  new Retirement();
            if($retirement->isValid($data)):

                $retirement->fill($data);
                $retirement->save();
                $youngBoy = new YoungBoy();
                Mail::send('youngBoys/registered',compact('data','youngBoy'),function ($e) use ($data){
                    $e->from('jaacscr@contadventista.org','Departamento de Jovenes ACSCR');
                    $e->to(currentUser()->email,currentUser()->nameComplete())->subject('Inscripcion Retiro!');
                });
                return redirect()->route('home')->with('alert', 'Se Registro Con exito');
            endif;
        endif;

        return redirect()->back()->withInput($request->input())
            ->withErrors($retirement->errors, $this->errorBag())->with('error', 'Tenemos un error');
    }

    public function lists()
    {
        $users = User::whereHas('youngBoy',function ($q){
            $q->whereHas('retirements',function ($r){
                $r->where('date','>','2017-01-01');
            });
        })->where('type_user','joven')->get();
        return view('youngBoys.listYoungBoys',compact('users'));
    }

    /*******************************************************
     * @Author     : Anwar Sarmiento Ramos
     * @Email      : asarmiento@sistemasamigables.com
     * @Create     : ${DATE}
     * @Update     : 0000-00-00
     ********************************************************
     * @Description:
     *
     *
     *
     * @Pasos      :
     *
     *
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     ********************************************************/
    public function profile()
    {
        return view('youngBoys.profile');
    }

    public function pdf()
    {
        Fpdf::AddPage('letter');
        Fpdf::SetFont('Courier', 'B', 18);
        Fpdf::Cell(0, 25, 'Lista de Jovenes Inscritos',0,1,'C');


        Fpdf::SetFont('Courier', 'B', 18);
        Fpdf::Cell(10, 10, 'N',1,0,'C');
        Fpdf::Cell(30, 10, 'Cedula',1,0,'C');
        Fpdf::Cell(90, 10, 'Nombre',1,0,'C');
        Fpdf::Cell(17, 10, 'Edad',1,0,'C');
        Fpdf::Cell(10, 10, 'T.',1,0,'C');
        Fpdf::Cell(25, 10, 'Genero',1,0,'C');
        Fpdf::Cell(60, 10, 'Iglesia',1,0,'C');
        Fpdf::Cell(40, 10, 'T. Pagado',1,1,'C');
        $users = User::whereHas('youngBoy',function ($q){
            $q->whereHas('retirements',function ($r){
                $r->where('date','>','2016-01-01')->orderBy('shirt_size','ASC');
            });
        })->orderBy('name','ASC')->get();
        $i=0;
        foreach ($users AS $user): $i++;
            Fpdf::SetFont('Courier', 'B', 10);

            Fpdf::Cell(10, 5, $i,1,0,'C');
            Fpdf::Cell(30, 5, $user->identification_card,1,0,'C');
            Fpdf::Cell(90, 5, utf8_decode(ucwords(strtolower($user->nameComplete()))),1,0,'L');
            Fpdf::Cell(17, 5, $user->youngBoy->age,1,0,'C');
            Fpdf::Cell(10, 5, $user->youngBoy->retirements[0]->shirt_size,1,0,'C');
            if($user->youngBoy->gender == 'man'):
            Fpdf::Cell(25, 5, 'Hombre',1,0,'C');
            else:
            Fpdf::Cell(25, 5, 'Mujer',1,0,'C');
            endif;
            Fpdf::Cell(60, 5, substr(utf8_decode(ucwords(strtolower($user->youngBoy->church))),0,27),1,0,'C');
            Fpdf::Cell(40, 5, number_format($user->youngBoy->retirements()->sum('amount')),1,1,'C');

        endforeach;

        Fpdf::Output();
        exit;
    }
}
