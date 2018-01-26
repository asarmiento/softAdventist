<?php

namespace App\Http\Controllers;

use App\Entities\Departaments\Departament;
use App\Entities\Departaments\ExpenseAccount;
use App\Entities\Departaments\IncomeAccount;
use App\Entities\SummaryOfWeeklyEarning;
use App\Http\Requests\IncomeAccountCreateRequest;
use App\Traits\DataViewerTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

/**
 * Class IncomeAccountController
 * @package App\Http\Controllers
 */
class IncomeAccountController extends Controller
{
    use DataViewerTraits;

    //

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: ${DATE}
     * @TimeCreate: $TIME$
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     *
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * ----------------------------------------------------------------------
     * *
     */
    public function index()
    {
        return view('departament.accounts.listsIncomeAccounts');
    }


    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-05
     * @TimeCreate: 8:50pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     * * @param Request $request
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return TYPE_NAME
     * ----------------------------------------------------------------------
     * *
     */
    public function getData(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        /** @var TYPE_NAME $model */
        $model = IncomeAccount::searchPaginateAndOrder($perPage, $request->get('search'),
            true)->where('type', 'temp')->with('departament.listDepartament')
            ->with('expensesAccounts')->paginate($perPage);

        /** @var TYPE_NAME $array */
        $array = $this->myPages($model);

        /** @var TYPE_NAME $columns */
        $columns = IncomeAccount::$columns;

        /** @var TYPE_NAME $response */
        $response = [
            'model' => $model,
            'columns' => $columns,
            'my_pages' => $array
        ];

        /** @var TYPE_NAME $response */
        return $response;
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
        $departaments = Departament::where('church_id', 1)->get();
        foreach ($departaments AS $departament):
            $value = ['value' => $departament->token, 'label' => $departament->listDepartament->name];
            array_push($contents, $value);
        endforeach;

        return view('departament.accounts.createIncome', compact('contents'));
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-06-23
     * @Time       Create: 8:51pm
     * @Date       Update: 2017-09-05
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     *
     * @param IncomeAccountCreateRequest $request
     * ----------------------------------------------------------------------
     *
     * @return \Illuminate\Http\JsonResponse
     * ----------------------------------------------------------------------
     */
    public function store(IncomeAccountCreateRequest $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        $departament = Departament::where('token', $data['departament_id']['value'])->first();
        $name = $data['name'];
        $data['name'] = 'Ing-' . $name;
        if ($data['checkedNames'] == true):
            $data['type'] = 'fix';
        endif;

        if (IncomeAccount::where('name', $data['name'])->where('departament_id', $departament->id)->count() > 0):
            DB::rollback();

            return response()->json(['name' => ['Ya existe ese nombre con ese Departamento']], 500);
        endif;
        $data['initial'] = '0';
        $data['balance'] = '0';
        $data['token'] = Crypt::encrypt(substr($data['name'], 0, 30));
        $data['departament_id'] = $departament->id;

        $incomeAccount = new IncomeAccount();
        $incomeAccount->fill($data);
        if ($incomeAccount->save()):
            $data['name'] = 'Gto-' . $name;
            $data['income_account_id'] = $incomeAccount->id;
            $expenseAccount = new ExpenseAccount();
            $expenseAccount->fill($data);
            if ($expenseAccount->save()) {
                DB::commit();

                return response()->json(['success' => true, 'message' => 'Se creo con Exito!!!!'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Genero un error'], 422);
            }
        else:
            return response()->json(['success' => false, 'message' => 'Genero un error'], 422);

        endif;


    }
}
