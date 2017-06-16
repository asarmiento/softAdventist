<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function convertionObjeto($request)
    {
        $DatosController = json_encode($request['data']);
        /** @var TYPE_NAME $DatosController */
        return $DatosController;
    }

    /* Con estos methodos enviamos los mensajes de exito en cualquier controlador */

    public function exito($data)
    {
        return [
            'success' => true,
            'message' => $data,
        ];
    }

    /* Con estos methodos enviamos los mensajes de error en cualquier controlador */

    public function errores($data)
    {
        return Response::json([
            'success' => false,
            'errors' => $data,
        ]);
    }

    public function CreacionArray($data, $delimiter, $md5 = false)
    {
        foreach ($data AS $key => $value):
            $newArreglo[$key] = ($value);
        endforeach;
        if (empty($newArreglo['token'])):

            if (isset($newArreglo['name'])):
                if($md5)
                {
                    $newArreglo['token'] = md5($newArreglo['name']);
                }else{
                    $newArreglo['token'] = Crypt::encrypt($newArreglo['name']);
                }

                return $newArreglo;

            elseif (isset($newArreglo['amount'])):

                $newArreglo['token'] = Crypt::encrypt($newArreglo['amount']);

                return $newArreglo;

            elseif (isset($newArreglo['code'])):

                $newArreglo['token'] = Crypt::encrypt($newArreglo['code']);

                return $newArreglo;

            elseif (isset($newArreglo['year'])):

                $newArreglo['token'] = Crypt::encrypt($newArreglo['year']);

                return $newArreglo;

            elseif (isset($newArreglo['fname'])):

                $newArreglo['token'] = Crypt::encrypt($newArreglo['fname']);

                return $newArreglo;
            elseif (isset($newArreglo['date'])):

                $newArreglo['token'] = Crypt::encrypt($newArreglo['date']);

                return $newArreglo;

            elseif (isset($newArreglo['coustomer_id'])):

                $newArreglo['token'] = Crypt::encrypt($newArreglo['coustomer_id']);

                return $newArreglo;
            endif;

            $newArreglo['token'] = Crypt::encrypt($newArreglo);

            return $newArreglo;
        endif;

        return $newArreglo;
    }
}
