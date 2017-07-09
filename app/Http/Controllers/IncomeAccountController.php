<?php

namespace App\Http\Controllers;

use App\Entities\Departament;
use App\Entities\ExpenseAccount;
use App\Entities\IncomeAccount;
use App\Entities\SummaryOfWeeklyEarnings;
use App\Http\Requests\IncomeAccountCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class IncomeAccountController extends Controller
{
    //
    public function index()
    {
        $incomesWeeklys = SummaryOfWeeklyEarnings::with('internal_control')->get();
        return view('IncomesAndExpenses.infoWeekly',compact('incomesWeeklys'));
    }

    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-06-26
     * @Time       Create: ${TIME}
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     * ----------------------------------------------------------------------
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * ----------------------------------------------------------------------
     */
    public function create()
    {
        $contents = [];
        $departaments = Departament::where('church_id',1)->get();
        foreach ($departaments AS $departament):
            $value = ['value'=>$departament->token, 'label'=>$departament->name];
        array_push($contents,$value);
        endforeach;

        return view('departament.accounts.createIncome',compact('contents'));
    }

    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-06-23
     * @Time       Create: ${TIME}
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     * @param IncomeAccountCreateRequest $request
     * ----------------------------------------------------------------------
     *
     * @return \Illuminate\Http\JsonResponse
     * ----------------------------------------------------------------------
     */
    public function store(IncomeAccountCreateRequest $request)
    {
        $data = $request->all();
        $departament = Departament::where('token',$data['departament_id']['value'])->first();
        $name = $data['name'];
        $data['name'] = 'Ing-'.$name;
        if($data['checkedNames'] == true):
            $data['type']='fix';
        endif;

        if(IncomeAccount::where('name',$data['name'])->where('departament_id',$departament->id)->count() > 0 ):
            return response()->json(['name'=>['Ya existe ese nombre con ese Departamento']],500);
        endif;
        $data['balance'] = '0';
        $data['token'] = Crypt::encrypt(substr($data['name'],0,30));
        $data['departament_id'] = $departament->id;

        $incomeAccount = new IncomeAccount();
        $incomeAccount->fill($data);
        if($incomeAccount->save()):
            $data['name'] = 'Gto-'.$name;
            $data['income_account_id'] = $incomeAccount->id;
            $expenseAccount = new ExpenseAccount();
            $expenseAccount->fill($data);
            if($expenseAccount->save())
                return response()->json(['success'=>true, 'message'=>'Se creo con Exito!!!!'],200);
        endif;


    }
}
