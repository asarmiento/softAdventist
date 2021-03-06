<?php

namespace App\Http\Controllers;

use app\Entities\ChurchLocalFieldIncomeAccount;
use App\Entities\Departaments\Departament;
use App\Entities\Departaments\IncomeAccount;
use App\Entities\InternalControl;
use App\Entities\LocalFieldIncome;
use App\Entities\LocalFieldIncomeAccount;
use App\Entities\Member;
use App\Entities\SummaryOfWeeklyEarning;
use App\Entities\TempIncomes;
use App\Entities\TempLocalFieldIncome;
use App\Entities\WeeklyIncome;
use App\Http\Requests\CreateWeeklyIncomeRequest;
use App\Traits\ConsultTablesTraits;
use App\Traits\DataViewerTraits;
use App\Traits\ListInformMembersTraits;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

/**
 * Class WeeklyIncomeController
 * @package App\Http\Controllers
 */
class WeeklyIncomeController extends Controller
{
    use ListInformMembersTraits;
    use DataViewerTraits;


    public function __construct()
    {
        
    }
    
    public function index()
    {
        $incomesWeeklys = SummaryOfWeeklyEarning::all();
        return view('IncomesAndExpenses.infoWeekly',compact('incomesWeeklys'));
    }

    public function getData(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        $model = SummaryOfWeeklyEarning::searchPaginateAndOrder($perPage, $request->get('search'));

        $array = $this->myPages($model);

        $columns = SummaryOfWeeklyEarning::$columns;
        $model['per_page'] = $perPage;

        $response = [
            'model'    => $model,
            'columns'  => $columns,
            'my_pages' => $array
        ];

        return $response;
    }
    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-06
     * @TimeCreate: 3:02 pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     * * @param $token
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * ----------------------------------------------------------------------
     * *
     */
    public function create($token)
    {

        $internalControl = InternalControl::where('token',$token)->first();
        //listado de miembros
        $allMembers = Member::all();
        $members=[];
        foreach ($allMembers AS $member):
            $data = ['value'=>$member->token,'label'=>$member->nameComplete()];
            array_push($members,$data);
        endforeach;
        //listado de cuentas para la asociacion
        $localIncomes = LocalFieldIncomeAccount::where('type','temp')->get();
        $account_local_fields = [];
        foreach ($localIncomes AS $incomeLocal):
            array_push($account_local_fields,['value'=>$incomeLocal->token,'label'=>$incomeLocal->name]);
        endforeach;
        //listado de cuentas de la iglesia
        $incomes = IncomeAccount::where('type','temp')->whereHas('departament',function ($q){
            $q->where('church_id',1);
        })->get();
        $account_incomes=[];
        foreach ($incomes AS $income):
            array_push($account_incomes,['value'=>$income->token,'label'=>$income->name]);
        endforeach;

        return view('IncomesAndExpenses.registerWeeklyIncomes',compact('internalControl',
            'members','account_incomes', 'account_local_fields'));
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-06
     * @TimeCreate: 3:02pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description: Aqui guardamos cada uno de los sobres segun sus cuentas
     * como esta estipulado
     * @pasos:
     * 1. recibimos los datos
     * 2. cargamos el numero de sobre en la variable $id
     * 3. Creamos un array para poder almacenarnos mas facil
     * ----------------------------------------------------------------------
     * * @param CreateWeeklyIncomeRequest $request
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return \Illuminate\Http\JsonResponse
     * ----------------------------------------------------------------------
     * *
     */
    public function store(CreateWeeklyIncomeRequest $request)
    {
        $data = $request->all();
        $id = $data['envelope_number'];
        try {
            DB::beginTransaction();
            /**
             * Variables y parametros nuevos
             */
            $dataLista = $this->createArray($data);

            /**
             * Aqui guardaremos los datos de 60% de la iglesia segun lo presupuestado
             */
            foreach ($dataLista['accountFix'] AS $accountFix):
                $church = $dataLista['church'];
                $church['balance'] = $dataLista['sixty'] * ($accountFix->departament->percent_of_budget / 100);
                $church['income_account_id'] = $accountFix->id;
                if ($church['balance'] > 0):
                    $weeklyIncome = new WeeklyIncome();
                    $weeklyIncome->fill($church);
                    $weeklyIncome->save();
                endif;
            endforeach;
            /**
             *  Aqui guardaremos los ingresos de las otras cuentas temporales
             *  de fondos de la iglesia
             */
            $accountTemps = TempIncomes::where('user_id', currentUser()->id)->get();
            foreach ($accountTemps AS $accountTemp):
                $church = $dataLista['church'];
                $church['balance'] = $accountTemp->balance;
                $church['income_account_id'] = $accountTemp->income_account_id;
                if ($church['balance'] > 0):
                    $weeklyIncome = new WeeklyIncome();
                    $weeklyIncome->fill($church);
                    $weeklyIncome->save();
                    TempIncomes::find($accountTemp->id)->delete();
                endif;
            endforeach;
            /**
             * Aqui guardaremos Diezmos y el 40% ofrenda de la parte de la asociacion
             */
            foreach ($dataLista['campo'] AS $localField):
                if ($localField['balance'] > 0):
                    $localFieldIncome = new LocalFieldIncome();
                    $localFieldIncome->fill($localField);
                    $localFieldIncome->save();
                endif;
            endforeach;
            /**
             * Aqui guardaremos los montos de las cuentas temporales de la
             * asociacion
             */
            $localFieldIncomes = TempLocalFieldIncome::where('user_id', currentUser()->id)->get();
            foreach ($localFieldIncomes AS $localFieldTemp):
                $campo = $dataLista['campoTemp'];
                $campo['balance'] = $localFieldTemp->balance;
                $campo['church_l_f_income_account_id'] = $localFieldTemp->church_l_f_income_account_id;
                if ($campo['balance'] > 0):
                    $localFieldIncome = new LocalFieldIncome();
                    $localFieldIncome->fill($campo);
                    $localFieldIncome->save();
                    TempLocalFieldIncome::find($localFieldTemp->id)->delete();
                endif;
            endforeach;
           // $date = InternalControl::find($data['internal_control_id'])->saturday;

            $datos = ($this->newMember($id,$dataLista['internalToken']));

            $result = $this->finishInfo($dataLista['internalToken']);
            $account = [];

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Se creo con Exito!!!!', 'newMember' => $datos['data'],
                'title' => $datos['title'], 'totalBalance' => $datos['totalBalance'],
                'totalRows' => $datos['totalRows'], 'account' => $account, 'result' => $result], 200);
        }catch (Exception $e){
            DB::rollback();
            echo json_encode($e->getMessage().' '.$e->getLine());
            die;
        }
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: ${DATE}
     * @Time       Create: ${TIME}
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     * @param $data
     * ----------------------------------------------------------------------
     *
     * @return array
     * ----------------------------------------------------------------------
     */
    public function createArray($data)
    {

        $forty= (($data['offering']+$data['background_inversion']) * 0.4);
        $sixty= (($data['offering']+$data['background_inversion']) * 0.6);
        $status = 'no aplicado';
        $internalControl = InternalControl::where('id',$data['internal_control_id'])->first();
        $member = Member::where('token',$data['member_id'])->first()->id;
        $accountFix = IncomeAccount::whereHas('departament',function ($q)use($internalControl){
            $q->where('church_id',$internalControl->church_id);
        })->where('type','fix')->get();

        // Consultamos los datos con type Diezmos
        $diezmo =  $this->accountLocalField($internalControl->church_id,'diez')->first()->id;
        //consultamos los datos con type offren
        $offering = $this->accountLocalField($internalControl->church_id,'offren')->first()->id;
        $token = Crypt::encrypt($data['envelope_number']);
        return [
            'internalToken'=>$internalControl->token,
            'accountFix'=>$accountFix,
            'sixty'=>$sixty,
            'church'=>[
                'envelope_number'=>$data['envelope_number'],
                'status'=>$status,
                'member_id'=>$member,
                'internal_control_id' =>$internalControl->id,
                'token'=>$token,
            ],
            'campoTemp'=>[
                'envelope_number'=>$data['envelope_number'],
                'status'=>$status,
                'member_id'=>$member,
                'internal_control_id' =>$internalControl->id,
                'token'=>$token
            ],
            'campo'=>[
                [
                    'envelope_number'=>$data['envelope_number'],
                    'status'=>$status,
                    'member_id'=>$member,
                    'internal_control_id' =>$internalControl->id,
                    'church_l_f_income_account_id'=>$diezmo,
                    'balance'=>$data['tithes'],
                    'token'=>$token,
                ],
                [
                    'envelope_number'=>$data['envelope_number'],
                    'status'=>$status,
                    'member_id'=>$member,
                    'internal_control_id' =>$internalControl->id,
                    'church_l_f_income_account_id'=>$offering,
                    'balance'=>$forty,
                    'token'=>$token,
                ]
            ]
            ];

    }


    public function checkFinishInfo($token)
    {
        return  response()->json($this->finishInfo($token),200);
    }
    public function finish(Request $request)
    {
        try {
            DB::beginTransaction();
            $date = $request->get('saturday');

            $sixty = WeeklyIncome::whereHas('incomeAccount', function ($q) {
                $q->where('type', 'fix');
            })->whereHas('internalControl',function ($r)use($date){
                $r->where('saturday',$date)->where('church_id',userChurch()->id);
            })->where('status', 'no aplicado')->sum('balance');

            $forty = LocalFieldIncome::whereHas('churchLFIncomeAccount', function ($q) {
                $q->whereHas('localFieldIncomeAccount',function ($y){
                    $y->where('type', 'offren');
                });
            })->whereHas('internalControl',function ($r)use($date){
                $r->where('saturday',$date)->where('church_id',userChurch()->id);
            })->where('status', 'no aplicado')->sum('balance');


            $tithes = LocalFieldIncome::whereHas('churchLFIncomeAccount', function ($q) {
                $q->whereHas('localFieldIncomeAccount',function ($y){
                    $y->where('type', 'diez');
                })->where('church_id',userChurch()->id);
            })->whereHas('internalControl',function ($r)use($date){
                $r->where('saturday',$date)->where('church_id',userChurch()->id);
            })->where('status', 'no aplicado')->sum('balance');



            $otherChurch = WeeklyIncome::whereHas('incomeAccount', function ($q) {
                $q->where('type', 'temp');
            })->whereHas('internalControl',function ($r)use($date){
                $r->where('saturday',$date)->where('church_id',userChurch()->id);
            })->where('status', 'no aplicado')->sum('balance');


            $other = LocalFieldIncome::whereHas('churchLFIncomeAccount', function ($q) {
                $q->whereHas('localFieldIncomeAccount',function ($y){
                    $y->where('type', 'temp');
                })->where('church_id',userChurch()->id);
            })->whereHas('internalControl',function ($r)use($date){
                $r->where('saturday',$date);
            })->where('status', 'no aplicado')->sum('balance');


            $control = InternalControl::where('status', 'no aplicado')->where('church_id',userChurch()->id)->where('saturday',$date)->first();
            //traemos la numeración
            $numeration = $this->numerationInfo();
            $token = Crypt::encrypt($numeration);
            $data = ['number' => $numeration,
                'token' => $token,
                'offering' => ($sixty + $forty),
                'sixty' => $sixty, 'forty' => $forty,
                'tithes' => $tithes, 'other_church' => $otherChurch, 'other' => $other, 'internal_control_id' => $control->id];

             SummaryOfWeeklyEarning::create($data);

            $localAccounts = ChurchLocalFieldIncomeAccount::where('church_id',userChurch()->id)->get();
            foreach ($localAccounts AS $localAccount):
                ChurchLocalFieldIncomeAccount::where('id', $localAccount->id)
                    ->update(['balance' => ($localAccount->balance + LocalFieldIncome::where('church_l_f_income_account_id', $localAccount->id)
                            ->whereHas('internalControl',function ($r)use($date){
                                $r->where('saturday',$date);
                            })->where('status', 'no aplicado')->sum('balance'))]);
            endforeach;


            $churchAccounts = IncomeAccount::whereHas('departament',function ($r){
                $r->where('church_id',userChurch()->id);
            })->get();
            foreach ($churchAccounts AS $localAccount):
                $balance = WeeklyIncome::where('income_account_id', $localAccount->id)
                    ->whereHas('internalControl',function ($r)use($date){
                        $r->where('saturday',$date);
                    })->where('status', 'no aplicado')->sum('balance');
                IncomeAccount::where('id', $localAccount->id)
                    ->update(['balance' => ($localAccount->balance + $balance)]);
                Departament::where('id', $localAccount->departament_id)->update(['balance' => (Departament::find($localAccount->departament_id)->balance + $balance)]);
            endforeach;


            $internal = InternalControl::where('church_id',userChurch()->id)->where('status', 'no aplicado')->where('saturday',$date);

            WeeklyIncome::where('internal_control_id',$internal->first()->id)->where('status', 'no aplicado')->update(['status' => 'aplicado']);

            LocalFieldIncome::where('internal_control_id',$internal->first()->id)->where('status', 'no aplicado')->update(['status' => 'aplicado']);

            $internal->update(['status' => 'aplicado']);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'listo'], 200);
        }catch (Exception $e){
            echo json_encode($e->getMessage());
            die;
            DB::rollback();
        }
    }
    public function removeLine(Request $request)
    {
        $token = InternalControl::where('id',(WeeklyIncome::where('envelope_number',$request->get('envelope'))->first()->internal_control_id))->first()->token;

        $finish = $this->finishInfo($token);
        WeeklyIncome::where('envelope_number',$request->get('envelope'))->delete();
        LocalFieldIncome::where('envelope_number',$request->get('envelope'))->delete();


        return response()->json(['success'=>true, 'message'=>$finish],200);

    }
}
