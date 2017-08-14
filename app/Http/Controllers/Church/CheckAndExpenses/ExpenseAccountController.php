<?php

namespace App\Http\Controllers\Church\CheckAndExpenses;

use App\Entities\ExpenseAccount;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseAccountCreateRequest;
use App\Repositories\CheckExpenseRepository;
use App\Repositories\CheckRepository;
use App\Repositories\ExpenseAccountRepository;
use App\Repositories\IncomeAccountRepository;
use App\Traits\DataViewerTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ExpenseAccountController extends Controller
{
    //
    use DataViewerTraits;
    /**
     * @var IncomeAccountRepository
     */
    private $incomeAccountRepository;

    /**
     * @var ExpenseAccountRepository
     */
    private $expenseAccountRepository;

    /**
     * @var CheckRepository
     */
    private $checkRepository;

    /**
     * @var CheckExpenseRepository
     */
    private $checkExpenseRepository;


    /**
     * ExpenseAccountController constructor.
     *
     * @param ExpenseAccountRepository $expenseAccountRepository
     * @param IncomeAccountRepository  $incomeAccountRepository
     * @param CheckRepository          $checkRepository
     * @param CheckExpenseRepository   $checkExpenseRepository
     */
    public function __construct(
        ExpenseAccountRepository $expenseAccountRepository,
        IncomeAccountRepository $incomeAccountRepository,
        CheckRepository $checkRepository,
        CheckExpenseRepository $checkExpenseRepository
    )
    {
        $this->incomeAccountRepository = $incomeAccountRepository;
        $this->expenseAccountRepository = $expenseAccountRepository;
        $this->checkRepository = $checkRepository;
        $this->checkExpenseRepository = $checkExpenseRepository;
    }


    public function create()
    {
        $accounts =$this->incomeAccountRepository->listSelects();
        return view('departament.accounts.createExpense', compact('accounts'));
    }


    public function getData(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        $model = ExpenseAccount::searchPaginateAndOrder($perPage, $request->get('search'));

        $array = $this->myPages($model);

        $columns = ExpenseAccount::$columns;
        $model['per_page'] = $perPage;

        $response = [
            'model'    => $model,
            'columns'  => $columns,
            'my_pages' => $array
        ];

        return $response;
    }

    public function store(ExpenseAccountCreateRequest $request)
    {
        $data = $request->all();
        $incomeAccount = $this->incomeAccountRepository->getModel()->where('token',$data['income_account_id']['value'])->first();
        $name = $data['name'];
        $data['name'] = 'Gto-'.$name;

        if($this->expenseAccountRepository->getModel()->where('name',$data['name'])->where('income_account_id',$incomeAccount->id)->count() > 0 ):
            return response()->json(['name'=>['Ya existe ese nombre con ese Tipo de Ingreso']],500);
        endif;
        $data['balance'] = '0';
        $data['token'] = Crypt::encrypt(substr($data['name'],0,30));
        $data['income_account_id'] = $incomeAccount->id;

        $expenseAccount = $this->expenseAccountRepository->getModel();
        $expenseAccount->fill($data);
        if($expenseAccount->save()):
               return response()->json(['success'=>true, 'message'=>'Se creo con Exito!!!!'],200);
        endif;
    }


}
