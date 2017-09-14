<?php

namespace App\Http\Controllers;

use App\Entities\ChurchLocalFieldIncomeAccount;
use App\Entities\LocalFieldIncomeAccount;
use App\Entities\TempLocalFieldIncome;
use App\Http\Requests\CreateTempLocalFieldIncomeRequest;
use App\Traits\ConsultTablesTraits;
use Illuminate\Http\Request;
use Psy\Exception\RuntimeException;

class TempLocalFieldIncomeController extends Controller
{
    use ConsultTablesTraits;
    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-11
     * @TimeCreate: 6:11pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     * * @param CreateTempLocalFieldIncomeRequest $request
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return \Illuminate\Http\JsonResponse
     * ----------------------------------------------------------------------
     * *
     */
    public function store(CreateTempLocalFieldIncomeRequest $request)
    {
        $data = $request->all();
        //datos
        $account = $this->firstAccountLocalField($data['local_field_income_account_id']);
        $data['church_l_f_income_account_id'] = $account->id;
        $data['user_id'] = currentUser()->id;
        //save
        $datos = new TempLocalFieldIncome();
        $datos->fill($data);
        $datos->save();
        $datos = TempLocalFieldIncome::with('ChurchLocalFieldIncomeAccount.localFieldIncomeAccount')->find($datos->id);
        echo json_encode($datos);
        die;
          return response()->json(['success'=>true, 'message'=>['Se creo con Exito!!!!'],'account'=>$datos],200);
    }

    public function remove(Request $request)
    {
       $delete= TempLocalFieldIncome::where('id',$request->get('id'))->delete();
        return response()->json(['success'=>true, 'message'=>[$delete]],200);
    }
}
