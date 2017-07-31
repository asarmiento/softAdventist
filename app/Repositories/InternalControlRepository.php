<?php
/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 13/07/2017
 * Time: 12:35 PM
 */

namespace App\Repositories;

use App\Entities\InternalControl;
use App\Traits\ConsultTablesTraits;

class InternalControlRepository extends BaseRepository
{
    use ConsultTablesTraits;
    /**
     * @return mixed
     */
    public function getModel()
    {
        return new InternalControl();// TODO: Implement getModel() method.
    }

    public function listPivotSelects()
    {
        $internals = $this->newQuery()->where('church_id',userChurch()->id)->get();
        return $this->listInfosActive($internals);
    }

    public function sumJoinTablePivotDeposit($token)
    {
        return $this->newQuery()->where('internal_controls.token',$token)
        ->join('church_deposit_internal_controls',
            'church_deposit_internal_controls.internal_control_id','=','internal_controls.id')
        ->sum('church_deposit_internal_controls.balance');
    }

    public function joinTablePivotDeposit($token)
    {
        return $this->newQuery()->where('internal_controls.token',$token)
            ->join('church_deposit_internal_controls',
                'church_deposit_internal_controls.internal_control_id','=','internal_controls.id')
            ->get();
    }
}