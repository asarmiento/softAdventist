<?php

namespace App\Http\Controllers;

use App\Entities\Retirement;
use App\Entities\YoungBoy;
use Carbon\Carbon;
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

        if($youngBoy->first()==null):
            $code = $year->format('Y').'-1';
        else:
            $separar = explode('-',$youngBoy->orderBy('code','DESC')->first()->code);
            $numeration = $separar[1]+1;
            $code = $year->format('Y').'-'.$numeration;
        endif;
        $saldo = 38500;
       if( $youngBoy->where('user_id',currentUser()->id)->count() ==0):
            return view('home',compact('youngBoy','code','saldo'));
       else:
           $youngBoy = $youngBoy->where('user_id',currentUser()->id)->first();
            $saldo = $saldo-$youngBoy->retirements()->sum('amount');
            return view('registered',compact('youngBoy','saldo'));
       endif;
    }



    public function store(Request $request)
    {
         $data = $request->all();
        try {
            DB::beginTransaction();
            $youngBoy = new YoungBoy();
            $data['user_id'] = currentUser()->id;
            $data['date'] = Carbon::now()->format('Y-m-d');


            if ($youngBoy->isValid($data)):
                $youngBoy->fill($data);
                $youngBoy->save();
                $data['young_boy_id'] = $youngBoy->id;
                if($youngBoy->count()>0):
                    $retirement = new Retirement();
                    if ($retirement->isValid($data)):
                        $retirement->fill($data);
                        $retirement->save();
                        Mail::send('youngBoys/emailInscription', compact('data', 'youngBoy'), function ($e) use ($data) {
                            $e->from('jaacscr@contadventista.org', 'Departamento de Jovenes ACSCR');
                            $e->to(currentUser()->email, currentUser()->nameComplete())->subject('Inscripcion Retiro!');
                        });
                        DB::commit();
                        return redirect()->route('create-inscription')->with('alert', 'Se Registro Con exito');
                    endif;
                    DB::rollback();
                    return redirect()->back()->with('error', 'Tenemos un error')->withInput($request->input())
                        ->withErrors($retirement->errors, $this->errorBag());
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
        $retirement =  new Retirement();
        if($retirement->isValid($data)):
            $retirement->fill($data);
            $retirement->save();
            $youngBoy = new YoungBoy();
            Mail::send('youngBoys/registered',compact('data','youngBoy'),function ($e) use ($data){
                $e->from('jaacscr@contadventista.org','Departamento de Jovenes ACSCR');
                $e->to(currentUser()->email,currentUser()->nameComplete())->subject('Inscripcion Retiro!');
            });
            return redirect()->route('create-inscription')->with('alert', 'Se Registro Con exito');
        endif;

        return redirect()->back()->withInput($request->input())
            ->withErrors($retirement->errors, $this->errorBag())->with('error', 'Tenemos un error');
    }
}
