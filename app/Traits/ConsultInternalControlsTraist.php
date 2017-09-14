<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 14/09/2017
 * Time: 11:48 AM
 */

namespace app\Traits;


use App\Entities\InternalControl;

trait ConsultInternalControlsTraist
{

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-14
     * @TimeCreate: 11:51am
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description: con sultamos los datos del la tabla solo por el token
     * @pasos:
     * ----------------------------------------------------------------------
     * * @param $token
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return \Illuminate\Database\Eloquent\Model|null|static
     * ----------------------------------------------------------------------
     * *
     */
    public function token($token)
    {
        return InternalControl::where('token',$token)->first();
    }
}