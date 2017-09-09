<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 27/06/2017
 * Time: 10:45 PM
 */

namespace App\Traits;

use App\Entities\Departaments\IncomeAccount;
use App\Entities\InternalControl;
use App\Entities\LocalFieldIncome;
use App\Entities\LocalFieldIncomeAccount;
use App\Entities\Member;
use App\Entities\SummaryOfWeeklyEarning;
use App\Entities\TempIncomes;
use App\Entities\TempLocalFieldIncome;
use App\Entities\WeeklyIncome;
use App\Repositories\IncomeAccountRepository;
use App\Repositories\LocalFieldIncomeAccountRepository;
use App\Repositories\LocalFieldIncomeRepository;
use App\Repositories\WeeklyincomeRepository;
use Illuminate\Http\Request;

/**
 * Trait ListInformMembersTraits
 * @package App\Traits
 */
trait ListInformMembersTraits
{




    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-07-11
     * @Time       Create: 2:00pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description: Creamos un array con todos los datos de cada sobre
     *             con cada una de las cantidades, se usa al agregar y en el
     *             PDF tambien.
     * @Pasos      : 1. Primero obtenemos los numero de sobres
     *             2. luego obtenemos el diezmos del sobre
     *             3. Obtenemos la ofrenda del 60,20,20 del sobre
     *             4. luego obtenemos las cuentas temp del campo local
     *             5. obtenemos los datos de las cuentas temp de la iglesia
     * @param bool $date
     * ----------------------------------------------------------------------
     *
     * @return array
     * ----------------------------------------------------------------------
     */
    public function listMemberInforme($date=false)
    {
        /**
         * filtramos los datos de los miembros que estan siendo
         * usados en el informe semanal de ingresos
         */
        try {

            $envelopes = $this->countEnvelopeList($date);

            $data = [];
            foreach ($envelopes AS $envelope):

                $tithes = LocalFieldIncomeAccount::join('local_field_incomes','local_field_incomes.local_field_income_account_id','=','local_field_income_accounts.id')
                    ->where('type','diez')->where('envelope_number',$envelope)->sum('local_field_incomes.balance');

                $offering = IncomeAccount::join('weekly_incomes','weekly_incomes.income_account_id','=','income_accounts.id')
                        ->where('type','fix')->where('envelope_number',$envelope)->sum('weekly_incomes.balance') +
                    LocalFieldIncomeAccount::join('local_field_incomes','local_field_incomes.local_field_income_account_id','=','local_field_income_accounts.id')
                        ->where('type','offren')->where('envelope_number',$envelope)->sum('local_field_incomes.balance') ;
                $member = Member::whereHas('weeklyIncomes', function ($q) use ($envelope) {
                    $q->where('envelope_number', $envelope);
                })->first();

                if (!$member):
                    $member = Member::whereHas('localFieldIncomes', function ($q) use ($envelope) {
                        $q->where('envelope_number', $envelope);
                    })->first();
                endif;
                $total =  WeeklyIncome::where('envelope_number', $envelope)->sum('balance')  +
                    LocalFieldIncome::where('envelope_number', $envelope)->sum('balance');
                $datos = [
                    'envelope' => $envelope,
                    'datos' => [
                        $member->nameComplete(),
                        $envelope,
                        ($total),
                        number_format($tithes, 2),
                        number_format($offering, 2)
                    ],

                ];
                $localfields = LocalFieldIncomeAccount::whereHas('localFieldIncomes', function ($q) use ($envelopes) {
                    $q->whereIn('envelope_number', $envelopes);
                })->where('type', 'temp')->get();
                //aqui agregamos en el array los datos de las cuentas que van para el campo local
                foreach ($localfields AS $localfieldIncome):
                    $list = $localfieldIncome->localFieldIncomes()->where('envelope_number', $envelope)->select('balance', 'id')->sum('balance');
                    if ($list > 0):
                        $datos['datos'][] = number_format($list, 2);
                    else:
                        $datos['datos'][] = number_format(0, 2);
                    endif;
                endforeach;
                $incomeAccounts = IncomeAccount::whereHas('weeklyIncomes', function ($q) use ($envelopes) {
                    $q->whereIn('envelope_number', $envelopes);
                })->where('type', 'temp')->get();
                // aqui agregamos las cuentas de ingreso de locales de la iglesia
                foreach ($incomeAccounts AS $churchIncome):
                    $list = $churchIncome->weeklyIncomes()->where('envelope_number', $envelope)->select('balance', 'id')->sum('balance');
                    if ($list > 0):
                        $datos['datos'][] = number_format($list, 2);
                    else:
                        $datos['datos'][] = number_format(0, 2);
                    endif;
                endforeach;

                array_push($data, $datos);
            endforeach;
            return $data;
        }catch (\Exception $e){
            echo json_encode($e->getMessage());
            die;
        }
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-07-11
     * @Time       Create: 2:00pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     * @param bool $date
     * ----------------------------------------------------------------------
     *
     * @return array
     * ----------------------------------------------------------------------
     */
    public function totalesInforme($date=false)
    {
        /**
         * filtramos los datos de los miembros que estan siendo
         * usados en el informe semanal de ingresos
         */
        $envelopes = $this->countEnvelopeList($date);
        $tithes = $this->localFieldIncomeAccountRepository->sumTypeForInEnvelope($envelopes,'diez');
        $offering = $this->incomeAccountRepository->sumTypeForInEnvelope($envelopes,'fix')  +
        $this->localFieldIncomeAccountRepository->sumTypeForInEnvelope($envelopes,'offren');
        $total = $this->weeklyincomeRepository->sumInInfo($envelopes) + $this->localFieldIncomeRepository->sumInInfo($envelopes);
        $datos = [
            number_format($total,2),
            number_format($tithes,2),
            number_format($offering,2)
            ];
            $localfields = $this->localFieldIncomeAccountRepository->getType('temp');
            //aqui agregamos en el array los datos de las cuentas que van para el campo local
            foreach ($localfields AS $localfieldIncome):
                $list = $this->localFieldIncomeRepository->sumInEnvelope($envelopes,$localfieldIncome->id);
                if($list > 0):
                    $datos[] = number_format($list,2);
                endif;
            endforeach;
            $incomeAccounts = $this->incomeAccountRepository->getType('temp');
            // aqui agregamos las cuentas de ingreso de locales de la iglesia
            foreach ($incomeAccounts AS $churchIncome):
                $list = $this->weeklyincomeRepository->sumInEnvelope($envelopes,$churchIncome->id);
                if($list > 0):
                    $datos[] = number_format($list,2);
                endif;
            endforeach;
        return $datos;
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-07-11
     * @Time       Create: 2:00pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:Unimos todos los datos para enviarlo a Vue.js
     * @Pasos      :
     * ----------------------------------------------------------------------
     * @return array
     * ----------------------------------------------------------------------
     */
    public function listEnvelopesCreate($date){

        $data = $this->listMemberInforme($date);
        $title = $this->titleInfo($date);

        // lista de movimientos temporales
        $internal = InternalControl::where('status','no aplicado')->first();
        $temp_LocalField_incomes = TempLocalFieldIncome::where('user_id',currentUser()->id)->with('localFieldIncomeAccount')->orderBy('id','DESC')->get();
        $temp_incomes = TempIncomes::where('user_id',currentUser()->id)->with('incomeAccount')->orderBy('id','DESC')->get();
        $totalBalance = WeeklyIncome::where('status', 'no aplicado')->sum('balance') +  LocalFieldIncome::where('status', 'no aplicado')->sum('balance');
        $totalRows = count($this->countEnvelopeList($date));
        $totalRowsW = 'style="width:'.(($totalRows/$internal->number_of_envelopes)*100).'%"';
        return  (['infoWeeklys' => $data,
                  'title'=>$title,
                  'totalBalance'=>$totalBalance,
                  'totalRows'=>$totalRows,
                  'totalRowsW'=>$totalRowsW,
                  'tempIncomes'=>$temp_incomes,
                  'tempLocalFieldIncomes'=>$temp_LocalField_incomes]);
    }
    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-06-27
     * @Time       Create: 10:00pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description: aqui contamos cuantos sobres han sido agregados en la
     *             tabla de la iglesia y del campo local y borramos las
     *             duplicadas para enviar una de cada una.
     * @Pasos      :
     * ----------------------------------------------------------------------
     * @return array
     * ----------------------------------------------------------------------
     */
    public function countEnvelopeList($date=false)
    {
        if($date):
            $internalTemp = InternalControl::where('saturday',$date)->where('church_id',1)->first();
        else:
            $internalTemp = InternalControl::where('status','no aplicado')->where('church_id',1)->first();
        endif;
        $churchs  =  WeeklyIncome::where('internal_control_id', $internalTemp->id)->distinct('envelope_number')->pluck('envelope_number');
        $data =  [];
           foreach ($churchs AS $church):
               array_push($data,$church);
               $locals =  LocalFieldIncome::where('internal_control_id', $internalTemp->id)->distinct('envelope_number')->pluck('envelope_number');
               foreach ($locals AS $local):
                 array_push($data,$local);
               endforeach;
           endforeach;
        return array_unique($data);
    }

    public function titleInfo($date=false)
    {
        $title =  [
            'Nombres',
            'Recibos N°',
            'Total',
            'Diezmos',
            'Ofrenda'
        ];
        $envelope = $this->countEnvelopeList($date);
        $localTitles = LocalFieldIncome::whereHas('localFieldIncomeAccount',function ($q){
            $q->where('type','temp');
        })->whereIn('envelope_number',$envelope)->distinct('local_field_income_account_id')->get();
        foreach ($localTitles AS $localTitle):
            array_push($title,$localTitle->localFieldIncomeAccount->name);
        endforeach;
        $churchTitles = WeeklyIncome::whereHas('incomeAccount',function ($q){
            $q->where('type','temp');
        })->whereIn('envelope_number',$envelope)->distinct('income_account_id')->get();
        foreach ($churchTitles AS $churchTitle):
            array_push($title,$churchTitle->incomeAccount->name);
        endforeach;
        return array_unique($title);
    }



    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-07-11
     * @Time       Create: 2:00pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description: Generamos la numeracion para el reporte PDF
     * @Pasos      :
     * @param $date
     * ----------------------------------------------------------------------
     *
     * @return string
     * ----------------------------------------------------------------------
     */
    public function numerationInfoPdf($date)
    {
        $numeration = SummaryOfWeeklyEarning::whereHas('internal_control',function ($q) use($date){
            $q->where('saturday',$date);
        })->max('number');
        if($numeration > 0 && $numeration < 10):
            return '0000'.$numeration;
        elseif ($numeration > 10 && $numeration < 100):
            return '000'.$numeration;
        elseif ($numeration > 100 && $numeration < 1000):
            return '00'.$numeration;
        elseif ($numeration > 1000 && $numeration < 10000):
            return '0'.$numeration;
        else:
            return $numeration;
        endif;
    }

    public function newMember($envelope)
    {
        /**
         * filtramos los datos de los miembros que estan siendo
         * usados en el informe semanal de ingresos
         */
         $data = [];

        $tithes = LocalFieldIncomeAccount::join('local_field_incomes','local_field_incomes.local_field_income_account_id','=','local_field_income_accounts.id')
            ->where('type','diez')->where('envelope_number',$envelope)->sum('local_field_incomes.balance');

        $offering = IncomeAccount::join('weekly_incomes','weekly_incomes.income_account_id','=','income_accounts.id')
                ->where('type','fix')->where('envelope_number',$envelope)->sum('weekly_incomes.balance') +
            LocalFieldIncomeAccount::join('local_field_incomes','local_field_incomes.local_field_income_account_id','=','local_field_income_accounts.id')
                ->where('type','offren')->where('envelope_number',$envelope)->sum('local_field_incomes.balance') ;
        $member = Member::whereHas('weeklyIncomes', function ($q) use ($envelope) {
            $q->where('envelope_number', $envelope);
        })->first();

        if (!$member):
            $member = Member::whereHas('localFieldIncomes', function ($q) use ($envelope) {
                $q->where('envelope_number', $envelope);
            })->first();
        endif;
        $total =  WeeklyIncome::where('envelope_number', $envelope)->sum('balance')  +
            LocalFieldIncome::where('envelope_number', $envelope)->sum('balance');
        $datos = [
            'envelope' => $envelope,
            'datos' => [
                $member->nameComplete(),
                $envelope,
                ($total),
                number_format($tithes, 2),
                number_format($offering, 2)
            ],

        ];
        $localfields = LocalFieldIncomeAccount::whereHas('localFieldIncomes', function ($q) use ($envelope) {
            $q->where('envelope_number', $envelope);
        })->where('type', 'temp')->get();
        //aqui agregamos en el array los datos de las cuentas que van para el campo local
        foreach ($localfields AS $localfieldIncome):
            $list = $localfieldIncome->localFieldIncomes()->where('envelope_number', $envelope)->select('balance', 'id')->sum('balance');
            if ($list > 0):
                $datos['datos'][] = number_format($list, 2);
            else:
                $datos['datos'][] = number_format(0, 2);
            endif;
        endforeach;
        $incomeAccounts = IncomeAccount::whereHas('weeklyIncomes', function ($q) use ($envelope) {
            $q->where('envelope_number', $envelope);
        })->where('type', 'temp')->get();
        // aqui agregamos las cuentas de ingreso de locales de la iglesia
        foreach ($incomeAccounts AS $churchIncome):
            $list = $churchIncome->weeklyIncomes()->where('envelope_number', $envelope)->select('balance', 'id')->sum('balance');
            if ($list > 0):
                $datos['datos'][] = number_format($list, 2);
            else:
                $datos['datos'][] = number_format(0, 2);
            endif;
        endforeach;

        array_push($data, $datos);

        $title =  $this->titleInfo();

        $totalBalance = WeeklyIncome::where('status', 'no aplicado')->sum('balance') +  LocalFieldIncome::where('status', 'no aplicado')->sum('balance');
        $totalRows = count($this->countEnvelopeList());


        return ['data'=>$data,'title'=>$title,'totalBalance'=>$totalBalance,
                'totalRows'=>$totalRows];
    }

    public function finishInfo()
    {
        $totalBalance = WeeklyIncome::where('status', 'no aplicado')->sum('balance') +  LocalFieldIncome::where('status', 'no aplicado')->sum('balance');
        $internal = InternalControl::where('status','no aplicado')->sum('balance');
        if($totalBalance == $internal):
            return ['success'=>true, 'message'=>['listo']];
        else:
            return ['success'=>false, 'message'=>['falta']];
        endif;

    }

    public function numerationInfo()
    {
        $actual = SummaryOfWeeklyEarning::max('number');
        if ($actual==null || $actual == ''):
            return 1;
        else:
            return ($actual +1);
        endif;
    }
}