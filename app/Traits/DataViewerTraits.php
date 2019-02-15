<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 23/07/2017
 * Time: 05:02 PM
 */

namespace App\Traits;

use App\Entities\YoungBoy;

trait DataViewerTraits
{
    public function scopeSearchPaginateAndOrder($query, $count, $search = null)
    {
        return $query->search($search)->paginate($count);
    }

    /**
     * ---------------------------------------------------------------------
     * @Author     : Francisco Gamonal "fgamonal@sistemasamigables.com"
     * @Date       Create: 2017-08-08
     * @Time       Create: 1:00pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     * @param $model
     * ----------------------------------------------------------------------
     *
     * @return array
     * ----------------------------------------------------------------------
     */
    public function myPages($model)
    {
        $array = [];
        if ($model->toArray()['last_page'] <= 7) {
            for ($i = 1; $i <= $model->toArray()['last_page']; $i++) {
                $array[] = $i;
            }
        } else {
            if ($model->toArray()['current_page'] <= 4) {
                for ($i = 1; $i <= 5; $i++) {
                    $array[] = $i;
                }
                $array[] = "...";
                $array[] = $model->toArray()['last_page'];
            } else {
                if ($model->toArray()['last_page'] - $model->toArray()['current_page'] < 4) {
                    $array[] = 1;
                    $array[] = "...";
                    $i = $model->toArray()['last_page'] - 4;
                    for ($i; $i <= $model->toArray()['last_page']; $i++) {
                        $array[] = $i;
                    }
                } else {
                    $array[] = 1;
                    $array[] = "...";
                    $array[] = $model->toArray()['current_page'] - 1;
                    $array[] = $model->toArray()['current_page'];
                    $array[] = $model->toArray()['current_page'] + 1;
                    $array[] = "...";
                    $array[] = $model->toArray()['last_page'];
                }
            }
        }
        return $array;
    }

    function codeBoys()
            {
        $codes = YoungBoy::max('code');

        if($codes)
        {
            $codes++ ;
        }else{
            $codes = 10000;
        }

                return $codes;
    }
}
