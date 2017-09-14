<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 15/07/2017
 * Time: 03:01 PM
 */

namespace App\Traits;

use App\Entities\ChurchLocalFieldIncomeAccount;
use App\Entities\Departaments\IncomeAccount;
use App\Entities\InternalControl;
use App\Entities\LocalFieldIncome;

trait ConsultTablesTraits
{
    use ConsultInternalControlsTraist;
    public function __construct()
    {
       // parent
    }


    public function listInfosActive($internals)
    {
        $contents= [];
        foreach ($internals AS $data):
            $churchDeposit = InternalControl::where('internal_controls.token',$data->token)
                ->join('church_deposit_internal_controls',
                    'church_deposit_internal_controls.internal_control_id',
                    '=','internal_controls.id');
            if($churchDeposit):
                if($data->balance > $churchDeposit->sum('church_deposit_internal_controls.balance')):
                    $value = ['value'=>$data->token, 'label'=>$data->saturday];
                    array_push($contents,$value);
                endif;
            else:
                $value = ['value'=>$data->token, 'label'=>$data->saturday];
                array_push($contents,$value);
            endif;
        endforeach;
        return $contents;
    }

    public function listInfosReport($internals)
    {
        $contents= [];
        foreach ($internals AS $data):
            $info = InternalControl::where('token',$data->token)->with('summaryOfWeeklyEarning.depositLocalFields')->get();
            if($info[0]->summaryOfWeeklyEarning->depositLocalFields->count() > 0):
                $value = ['value'=>$data->token, 'label'=>$data->saturday];
                    array_push($contents,$value);
            endif;
        endforeach;
        return $contents;
    }

    public function listInfosSinReport($internals)
    {
        $contents= [];
        foreach($internals AS $data):
           $info = InternalControl::where('token',$data->token)->with('summaryOfWeeklyEarning.depositLocalFields')->get();
           if($info[0]->summaryOfWeeklyEarning->depositLocalFields->count() == 0):
               $value = ['value'=>$data->token, 'label'=>$data->saturday];
                array_push($contents,$value);
            endif;
        endforeach;
        return $contents;
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-11
     * @TimeCreate: 5:41pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description: Consulta los datos de las cuentas asignadas a sin el resultado
     * @pasos: se usa en:
     * 1. la function createArray Class WeeklyIncomeController
     * ----------------------------------------------------------------------
     * @param $data
     * @param $type
     * @var ${TYPE_NAME}
     * ----------------------------------------------------------------------
     * @return mixed
     * ----------------------------------------------------------------------
     *
     */
    public function accountLocalField($data, $type){
        return ChurchLocalFieldIncomeAccount::whereHas('localFieldIncomeAccount', function ($q) use($type){
            $q->where('type',$type);
        })->where('church_id',$data);
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-11
     * @TimeCreate: 6:14pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description: con este metodo obtenemos los datos de la cuenta del
     * campo local y la relación
     * @pasos:
     * ----------------------------------------------------------------------
     * @param $token
     * @var ${TYPE_NAME}
     * ----------------------------------------------------------------------
     * @return \Illuminate\Database\Eloquent\Model|null|static
     * ----------------------------------------------------------------------
     * *
     */
    public function firstAccountLocalField($token){
      return   ChurchLocalFieldIncomeAccount::whereHas('localFieldIncomeAccount',function ($q)use($token){
            $q->where('token',$token);
        })->first();
    }

    public function typeEnvelopeAllLFI($type) {
       return LocalFieldIncome::whereHas('churchLFIncomeAccount',function ($q) use($type){
            $q->whereHas('localFieldIncomeAccount',function ($r) use ($type){
                $r->where('type',$type);
            });
        });
    }

    public function typeEnvelopeSumLFI($envelope,$type)
    {
        return LocalFieldIncome::whereHas('churchLFIncomeAccount',function ($q) use($type){
            $q->whereHas('localFieldIncomeAccount',function ($r) use ($type){
                $r->where('type',$type);
            });
        })->where('envelope_number', $envelope)->sum('local_field_incomes.balance');
    }

    public function typeEnvelopeSum($envelope, $type)
    {
        return IncomeAccount::join('weekly_incomes', 'weekly_incomes.income_account_id', '=', 'income_accounts.id')
            ->where('type', $type)->where('envelope_number', $envelope)->sum('weekly_incomes.balance');
    }
}