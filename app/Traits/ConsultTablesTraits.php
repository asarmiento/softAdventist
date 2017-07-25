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
                ->join('church_deposit_internal_control',
                    'church_deposit_internal_control.internal_control_id',
                    '=','internal_controls.id');
            if($churchDeposit):
                if($data->balance > $churchDeposit->sum('church_deposit_internal_control.balance')):
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
}