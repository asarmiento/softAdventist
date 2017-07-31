<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 31/07/2017
 * Time: 03:56 PM
 */

namespace App\Traits;

use App\Entities\CheckExpense;

trait AccountDepartamentTraits
{
    public function numerationGto()
    {
        $actual = CheckExpense::whereHas('check',function ($e){
            $e->whereHas('bank',function ($r){
                $r->where('church_id',userChurch()->id);
            });
        }  )->max('reference');
        if ($actual==null || $actual == ''):
            return 1;
        else:
            return ($actual +1);
        endif;
    }
}