<?php

namespace App\Http\Controllers;

use App\Entities\Retirement;
use App\Entities\User;
use App\Entities\YoungBoy;
use App\Traits\DataViewerTraits;
use Carbon\Carbon;
use Codedge\Fpdf\Facades\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    use DataViewerTraits;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
               return view('home');

    }
    public function image($type,$month,$name)
    {try {
    	return response()->download(
	        storage_path('app/'.$type.'/'.$month.'/' . $name),
	        $name,
	        [],
	        ResponseHeaderBag::DISPOSITION_INLINE
        );
    }catch (\Exception $e){
        echo json_encode($e->getMessage());
        die;
    }
    }

    public function help()
    {
        return view('help');
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
       $allYoungBoys = YoungBoy::all(); $i=0;
       foreach ($allYoungBoys AS $allYoungBoy):
           if((38500-$allYoungBoy->retirements()->sum('amount')) > 0):
               $i++;
           endif;
       endforeach;
       if( $youngBoy->where('user_id',currentUser()->id)->count() ==0):
            return view('home',compact('youngBoy','code','saldo','registros','allYoungBoys','i'));
       else:
           $youngBoy = $youngBoy->where('user_id',currentUser()->id)->first();
            $saldo = $saldo-$youngBoy->retirements()->sum('amount');
            return view('registered',compact('youngBoy','saldo','registros','allYoungBoys','i'));
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
    public function upload(Request $request)
    {
        $file = $request->file('items');
        $name = 'temp' . rand(1, 2000);
        $file->storeAs('boys', $name);

        return response()->json($name, 200);
    }

    public function registered(Request $request)
    {
        $data = $request->all();
            if(!$data['launch']){
                $data['launch'] = false;
            }
        $data['code'] =$this->codeBoys();
        $data['birthdate'] =Carbon::now()->format('Y-m-d');
        $data['church'] = auth()->user()->member->church_id;
        $data['user_id'] = auth()->user()->id;
        $data['address'] = '';

                $retirement = new YoungBoy();
                $retirement->fill($data);
                if($retirement->save()) {
                    $youngBoy = YoungBoy::with('churchD')->find($retirement->id);
                     Mail::send('youngBoys/registered',compact('data','youngBoy'),function ($e) use ($data,$retirement){
                          $e->from('registro@jovenesadventistascr.com','Departamento de Jovenes ACSCR');
                          $e->to($retirement->email,$retirement->nameComplete())->subject('Registrado en el Congreso Juvenil!');
                      });
                    $retirement->total = $retirement->where('launch',true)->count();

                    return response()->json(['success'=>true,'message'=>'Se guardo Con Exito','boy'=>$retirement],200);
                }


        return redirect()->back()->withInput($request->input())
            ->withErrors($retirement->errors, $this->errorBag())->with('error', 'Tenemos un error');
    }

    public function lists()
    {
        $boys = YoungBoy::where('church',auth()->user()->member->church_id)->with('church')->with('user')->get();
        $boys->map(function ($boy){
            $boy->total = $boy->where('launch',true)->where('church',auth()->user()->member->church_id)->count();
        });

        return $boys;

    }
   public function updatelaunch($id)
    {
        if(YoungBoy::find($id)->launch) {
            YoungBoy::where('id', $id)->update(['launch' =>false]);
        }else{
            YoungBoy::where('id', $id)->update(['launch' =>true]);
        }
        $boys = YoungBoy::where('church',auth()->user()->member->church_id)->with('church')->with('user')->get();
        $boys->map(function ($boy){
            $boy->total = $boy->where('launch',true)->where('church',auth()->user()->member->church_id)->count();
        });

        return $boys;

    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        DB::delete("DELETE FROM `young_boys` WHERE id = ".$id);
        return response()->json(['success'=>true,'message'=>'Se guardo Con Exito'],200);
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

    public function excelList()
    {
        $content = [];
        $headerT =['Lista de Jovenes Inscritos' ];
        array_push($content,$headerT);

        $users = User::whereHas('youngBoy',function ($q){
            $q->whereHas('retirements',function ($r){
                $r->where('date','>','2016-01-01')->orderBy('shirt_size','ASC');
            });
        })->orderBy('name','ASC')->get();
        $i=0;
        $headerT =['#','Nombre','apellidos','iglesia',	'sexo','edad','talla','saldo pendiente' ];
        array_push($content,$headerT);
        foreach ($users AS $user):
            if($user->youngBoy->gender == 'man'):
                $gender = 'Hombre';
            else:
                $gender =  'Mujer';
            endif;
            if(38500-$user->youngBoy->retirements()->sum('amount')):
                $saldo = number_format(38500-$user->youngBoy->retirements()->sum('amount'));
            else:
                $saldo = 'Pagado Todo';
            endif;
            if($user->youngBoy->status == 'activo'):

                $data = [ $i,
                    (ucwords(($user->name))),
                    (ucwords(($user->last_name))),
                    ((ucwords(($user->youngBoy->church)))),
                    $gender ,
                    $user->youngBoy->age,
                    $user->youngBoy->retirements[0]->shirt_size,
                     $saldo
                ];
                array_push($content,$data);
            endif;
        endforeach;


        $i=0;
        $headerT =['#','Nombre','apellidos','iglesia',	'sexo','edad','talla','saldo pendiente' ];
        array_push($content,$headerT);
        $headerT =['Lista de Jovenes Eliminados' ];
        array_push($content,$headerT);
        foreach ($users AS $user):
            if($user->youngBoy->gender == 'man'):
                $gender = 'Hombre';
            else:
                $gender =  'Mujer';
            endif;
            $saldo = number_format($user->youngBoy->retirements()->sum('amount'));

            if($user->youngBoy->status != 'activo'):
                $i++;
                $data = [ $i,
                    (ucwords(($user->name))),
                    (ucwords(($user->last_name))),
                    ((ucwords(($user->youngBoy->church)))),
                    $gender ,
                    $user->youngBoy->age,
                    $user->youngBoy->retirements[0]->shirt_size,
                    $saldo
                ];
                array_push($content,$data);
            endif;
        endforeach;
        Excel::create('Lista de Jovenes Inscritos', function($excel) use ($content) {
            $excel->sheet('Sheetname', function($sheet) use($content){
                $sheet->cells('A1:H1', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->cells('A1:H2', function($cells) {
                     $cells->setFontWeight('bold');
                });
                $sheet->mergeCells('A1:H1');
                $sheet->fromArray($content, null, 'A1', false, false);

            });

        })->export('xlsx');
    }

    public function status($id)
    {

        $data = YoungBoy::find($id);

        if($data->status == 'activo'):
            YoungBoy::where('id',$id)->update(['status'=>'eliminado']);
        else:
            YoungBoy::where('id',$id)->update(['status'=>'activo']);
        endif;

        return redirect()->back();

    }
}
