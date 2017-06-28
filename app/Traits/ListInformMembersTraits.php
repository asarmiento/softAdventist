<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 27/06/2017
 * Time: 10:45 PM
 */

namespace App\Traits;

use App\Entities\IncomeAccount;
use App\Entities\InternalControl;
use App\Entities\LocalFieldIncome;
use App\Entities\LocalFieldIncomeAccount;
use App\Entities\Member;
use App\Entities\SummaryOfWeeklyEarnings;
use App\Entities\TempIncomes;
use App\Entities\TempLocalFieldIncome;
use App\Entities\WeeklyIncome;

trait ListInformMembersTraits
{
    public function listMemberInforme()
    {
        /**
         * filtramos los datos de los miembros que estan siendo
         * usados en el informe semanal de ingresos
         */
        $envelopes = $this->countEnvelopeList();

        $data = [];
        foreach ($envelopes[0] AS $envelope):

            $tithes = LocalFieldIncomeAccount::join('local_field_incomes','local_field_incomes.local_field_income_account_id','=','local_field_income_accounts.id')
                ->where('type','diez')->where('envelope_number',$envelope)->sum('local_field_incomes.balance');

            $offering = IncomeAccount::join('weekly_incomes','weekly_incomes.income_account_id','=','income_accounts.id')
                    ->where('type','fix')->where('envelope_number',$envelope)->sum('weekly_incomes.balance')  +
                LocalFieldIncomeAccount::join('local_field_incomes','local_field_incomes.local_field_income_account_id','=','local_field_income_accounts.id')
                    ->where('type','offren')->where('envelope_number',$envelope)->sum('local_field_incomes.balance')  ;

            $member = Member::whereHas('weeklyIncomes',function ($q) use($envelope){
                $q->where('envelope_number',$envelope);
            })->first();

            $datos = [
                'envelope'=>$envelope,
                'datos'=>[
                    $member->nameComplete(),
                    $envelope,
                    number_format($tithes,2),
                    number_format($offering,2)
                ],

            ];
            $localfields = LocalFieldIncomeAccount::whereHas('localFieldIncomes',function ($q){
                $q->where('status','no aplicado');
            })->where('type','temp')->get();
            //aqui agregamos en el array los datos de las cuentas que van para el campo local
            foreach ($localfields AS $localfieldIncome):
                $list = $localfieldIncome->localFieldIncomes()->where('envelope_number',$envelope)->select('balance','id')->where('status','no aplicado')->sum('balance');
                if($list > 0):
                    $datos['datos'][] = number_format($list,2);
                else:
                    $datos['datos'][] = '';
                endif;
            endforeach;
            $incomeAccounts = IncomeAccount::whereHas('weeklyIncomes',function ($q){
                $q->where('status','no aplicado');
            })->where('type','temp')->get();
            // aqui agregamos las cuentas de ingreso de locales de la iglesia
            foreach ($incomeAccounts AS $churchIncome):
                $list = $churchIncome->weeklyIncomes()->where('envelope_number',$envelope)->select('balance','id')->where('status','no aplicado')->sum('balance');
                if($list > 0):
                    $datos['datos'][] = number_format($list,2);
                else:
                    $datos['datos'][] = '';
                endif;
            endforeach;

            array_push($data,$datos);
        endforeach;
        $title =  [
            'Nombres',
            'Recibos N°',
            'Diezmos',
            'Ofrenda'
        ];
        $localTitles = LocalFieldIncome::whereHas('localFieldIncomeAccount',function ($q){
            $q->where('type','temp');
        })->where('status','no aplicado')->get();
        foreach ($localTitles AS $localTitle):
            array_push($title,$localTitle->localFieldIncomeAccount->name);
        endforeach;
        $churchTitles = WeeklyIncome::whereHas('incomeAccount',function ($q){
            $q->where('type','temp');
        })->where('status','no aplicado')->get();
        foreach ($churchTitles AS $churchTitle):
            array_push($title,$churchTitle->incomeAccount->name);
        endforeach;


        // lista de movimientos temporales
        $temp_LocalField_incomes = TempLocalFieldIncome::where('user_id',currentUser()->id)->with('localFieldIncomeAccount')->orderBy('id','DESC')->get();
        $temp_incomes = TempIncomes::where('user_id',currentUser()->id)->with('incomeAccount')->orderBy('id','DESC')->get();
        $totalBalance = WeeklyIncome::where('status', 'no aplicado')->sum('balance') +  LocalFieldIncome::where('status', 'no aplicado')->sum('balance');
        $totalRows = count($this->countEnvelopeList()[0]);

        return  (['infoWeeklys' => $data,
                                  'title'=>$title,
                                  'totalBalance'=>$totalBalance,
                                  'totalRows'=>$totalRows,
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
    private function countEnvelopeList()
    {   $data1 = [];
        $church  =  WeeklyIncome::where('status', 'no aplicado')->distinct('envelope_number')->pluck('envelope_number');
        array_push($data1,$church);
        $local =  LocalFieldIncome::where('status', 'no aplicado')->distinct('envelope_number')->pluck('envelope_number');
        array_push($data1,$local);

        return array_unique($data1);
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
                    ->where('type','fix')->where('envelope_number',$envelope)->sum('weekly_incomes.balance')  +
                LocalFieldIncomeAccount::join('local_field_incomes','local_field_incomes.local_field_income_account_id','=','local_field_income_accounts.id')
                    ->where('type','offren')->where('envelope_number',$envelope)->sum('local_field_incomes.balance')  ;

            $member = Member::whereHas('weeklyIncomes',function ($q) use($envelope){
                $q->where('envelope_number',$envelope);
            })->first();

            $datos = [
                'envelope'=>$envelope,
                'datos'=>[
                    $member->nameComplete(),
                    $envelope,
                    number_format($tithes,2),
                    number_format($offering,2)
                ],

            ];
            $localfields = LocalFieldIncomeAccount::whereHas('localFieldIncomes',function ($q){
                $q->where('status','no aplicado');
            })->where('type','temp')->get();
            //aqui agregamos en el array los datos de las cuentas que van para el campo local
            foreach ($localfields AS $localfieldIncome):
                $list = $localfieldIncome->localFieldIncomes()->where('envelope_number',$envelope)->select('balance','id')->where('status','no aplicado')->sum('balance');
                if($list > 0):
                    $datos['datos'][] = number_format($list,2);
                else:
                    $datos['datos'][] = '';
                endif;
            endforeach;
            $incomeAccounts = IncomeAccount::whereHas('weeklyIncomes',function ($q){
                $q->where('status','no aplicado');
            })->where('type','temp')->get();
            // aqui agregamos las cuentas de ingreso de locales de la iglesia
            foreach ($incomeAccounts AS $churchIncome):
                $list = $churchIncome->weeklyIncomes()->where('envelope_number',$envelope)->select('balance','id')->where('status','no aplicado')->sum('balance');
                if($list > 0):
                    $datos['datos'][] = number_format($list,2);
                else:
                    $datos['datos'][] = '';
                endif;
            endforeach;

            array_push($data,$datos);

        $title =  [
            'Nombres',
            'Recibos N°',
            'Diezmos',
            'Ofrenda'
        ];
        $localTitles = LocalFieldIncome::whereHas('localFieldIncomeAccount',function ($q){
            $q->where('type','temp');
        })->where('status','no aplicado')->get();
        foreach ($localTitles AS $localTitle):
            array_push($title,$localTitle->localFieldIncomeAccount->name);
        endforeach;
        $churchTitles = WeeklyIncome::whereHas('incomeAccount',function ($q){
            $q->where('type','temp');
        })->where('status','no aplicado')->get();
        foreach ($churchTitles AS $churchTitle):
            array_push($title,$churchTitle->incomeAccount->name);
        endforeach;

        $totalBalance = WeeklyIncome::where('status', 'no aplicado')->sum('balance') +  LocalFieldIncome::where('status', 'no aplicado')->sum('balance');
        $totalRows = count($this->countEnvelopeList()[0]);


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
        $actual = SummaryOfWeeklyEarnings::max('number');
        if ($actual==null || $actual == ''):
            return 1;
        else:
            return ($actual +1);
        endif;
    }
}