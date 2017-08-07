<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 15/07/2017
 * Time: 03:01 PM
 */

namespace App\Traits;

use App\Entities\InternalControl;

trait ConsultTablesTraits
{
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
}