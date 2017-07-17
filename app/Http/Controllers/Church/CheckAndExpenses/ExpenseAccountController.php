<?php

namespace App\Http\Controllers\Church\CheckAndExpenses;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseAccountCreateRequest;
use App\Repositories\CheckRepository;
use App\Repositories\ExpenseAccountRepository;
use App\Repositories\IncomeAccountRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ExpenseAccountController extends Controller
{
    //

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
     * ExpenseAccountController constructor.
     *
     * @param ExpenseAccountRepository $expenseAccountRepository
     * @param IncomeAccountRepository  $incomeAccountRepository
     * @param CheckRepository          $checkRepository
     */
    public function __construct(
        ExpenseAccountRepository $expenseAccountRepository,
        IncomeAccountRepository $incomeAccountRepository,
        CheckRepository $checkRepository
    )
    {
        $this->incomeAccountRepository = $incomeAccountRepository;
        $this->expenseAccountRepository = $expenseAccountRepository;
        $this->checkRepository = $checkRepository;
    }


    public function create()
    {
        $accounts =$this->incomeAccountRepository->listSelects();
        return view('departament.accounts.createExpense', compact('accounts'));
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

    public function createInvoices()
    {
        $accounts =$this->expenseAccountRepository->filterChurchRelation('departament');
        $checks = $this->checkRepository->filterChurchRelation('bank');
        return view('IncomesAndExpenses.accounts.registroExpense', compact('accounts','checks'));
    }
}
