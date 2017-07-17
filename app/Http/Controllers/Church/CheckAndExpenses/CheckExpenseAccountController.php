<?php

namespace App\Http\Controllers\Church\CheckAndExpenses;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseAccountCreateRequest;
use App\Repositories\CheckExpenseRepository;
use App\Repositories\CheckRepository;
use App\Repositories\ExpenseAccountRepository;
use App\Repositories\IncomeAccountRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CheckExpenseAccountController extends Controller
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
        $accounts =$this->expenseAccountRepository->listSelects();
        $checks = $this->checkRepository->filterChurchRelation('bank');
        return view('IncomesAndExpenses.accounts.registroExpense', compact('accounts','checks'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $expenseAccount = $this->expenseAccountRepository->getModel()->where('token',$data['expense_account']['value'])->first();


        $data['token'] = Crypt::encrypt(substr($data['number'],0,30));
        $data['expense_account_id'] = $expenseAccount->id;
        $data['image'] = ".";
        $data['user_id'] = currentUser()->id;
        $expense = $this->checkExpenseRepository->getModel();
        $expense->fill($data);
        if($expense->save()):
            return response()->json(['success'=>true, 'message'=>'Se creo con Exito!!!!','result'=>$expense],200);
        endif;
    }

    public function listsNoAplicado()
    {
        return $this->checkExpenseRepository
            ->filterChurchRelationNot('expenseAccount.incomeAccount.departament');
    }

    public function listsAplicado()
    {
        return $this->checkExpenseRepository
            ->filterChurchRelationOk('expenseAccount.incomeAccount.departament','aplicado');
    }

    public function lists()
    {
        return view('IncomesAndExpenses.accounts.listsExpense');
    }
}
