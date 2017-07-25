<?php

namespace App\Http\Controllers\Church\CheckAndExpenses;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseAccountCreateRequest;
use App\Repositories\CheckExpenseRepository;
use App\Repositories\CheckRepository;
use App\Repositories\ExpenseAccountRepository;
use App\Repositories\IncomeAccountRepository;
use Hamcrest\Thingy;
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
    ) {
        $this->incomeAccountRepository = $incomeAccountRepository;
        $this->expenseAccountRepository = $expenseAccountRepository;
        $this->checkRepository = $checkRepository;
        $this->checkExpenseRepository = $checkExpenseRepository;
    }


    public function create()
    {
        $accounts = $this->expenseAccountRepository->listSelects();
        $checks = $this->checkRepository->filterChurchRelation('bank');
        $expense = $this->checkExpenseRepository->filterChurchRelationNot('expenseAccount.incomeAccount.departament');
        $balance = $this->balanceNot(null);

        return view('IncomesAndExpenses.accounts.registroExpense', compact('accounts', 'checks', 'expense', 'balance'));
    }


    public function createCheck($token)
    {
        $accounts = $this->expenseAccountRepository->listSelects();
        $check = $this->checkRepository->token($token);
        $expense = $this->checkExpenseRepository->filterChurchRelationNot('expenseAccount.incomeAccount.departament',
                $check->id);
        $balance = $this->balanceNot($check->id);

        return view('IncomesAndExpenses.accounts.registroCheckExpense',
            compact('accounts', 'check', 'expense', 'balance'));
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $expenseAccount = $this->expenseAccountRepository->getModel()->where('token',
            $data['expense_account']['value'])->first();
        if ($data['token_check']) {
            $data['check_id'] = $this->checkRepository->token($data['token_check'])->id;
        }

        $data['token'] = Crypt::encrypt(substr($data['number'], 0, 30));
        $data['expense_account_id'] = $expenseAccount->id;
        $data['image'] = ".";
        $data['user_id'] = currentUser()->id;
        $expense = $this->checkExpenseRepository->getModel();
        $expense->fill($data);
        if ($expense->save()):
            return response()->json([
                'success' => true,
                'message' => 'Se creo con Exito!!!!',
                'result'  => $expense,
                'balance' => $this->balanceNot($expense->check_id)
            ], 200);
        endif;
    }


    public function listsNoAplicado()
    {
        $expense = $this->checkExpenseRepository->filterChurchRelationNot('expenseAccount.incomeAccount.departament');

        return response()->json([
            'success' => true,
            'message' => 'Se creo con Exito!!!!',
            'result'  => $expense,
            'balance' => $this->balanceNot()
        ], 200);
    }


    public function listsAplicado()
    {
        return $this->checkExpenseRepository->filterChurchRelationOk('expenseAccount.incomeAccount.departament',
                'aplicado');
    }


    public function lists()
    {
        return view('IncomesAndExpenses.accounts.listsExpense');
    }


    public function balanceNot($check = null)
    {
        return $this->checkExpenseRepository->sumStatus('no aplicado', $check);

    }


    public function balanceNotC()
    {
        return $this->checkExpenseRepository->sumStatus('no aplicado');

    }


    public function destroy(Request $request)
    {
        $expense = $this->checkExpenseRepository->getModel()->where('id', $request->get('id'))->delete();
        if ($expense) {
            return response()->json([
                'success' => true,
                'message' => 'Se elimino con Exito!!!!',
                'balance' => $this->balanceNot($request->check_id)
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => $expense->errors,
            'balance' => $this->balanceNot($request->check_id)
        ], 422);
    }


    public function finish(Request $request)
    {
        if ( ! $request->all()) {
            $numeration=$list= $this->checkExpenseRepository->numeration();
            $this->checkExpenseRepository->getModel()->whereHas('expenseAccount.incomeAccount.departament',
                function ($q) {
                    $q->where('church_id', 1);
                })->where('status', 'no aplicado')->update([ 'status' => 'aplicado','reference'=>$numeration]);

            return response()->json([ 'success' => true,'message'=>$numeration ], 200);
        }
        if ($request->get('balance') == $this->balanceNot($request->get('id'))) {
            $numeration=$list= $this->checkExpenseRepository->numeration();
            $this->checkRepository->getModel()->where('id', $request->get('id'))->update([ 'status' => 'aplicado' ]);
            $this->checkExpenseRepository->getModel()->where('check_id',
                $request->get('id'))->update([ 'status' => 'aplicado','reference'=>$numeration ]);

            return response()->json([ 'success' => true,'message'=>$numeration ], 200);
        } elseif ($request->get('balance') > $this->balanceNot($request->get('id'))) {
            $balance = $request->get('balance') - $this->balanceNot($request->get('id'));

            return response()->json([ 'success' => true,
                                      'message' => 'Todavia debe registrar mas gastos por: '.number_format($balance,
                                              2).' !!!'
            ], 422);
        } elseif ($request->get('balance') < $this->balanceNot($request->get('id'))) {
            $balance = $this->balanceNot($request->get('id')) - $request->get('balance');

            return response()->json([ 'success' => true,
                                      'message' => 'Se ha Excedido debe quitar gastos por: '.number_format($balance,
                                              2).' !!!'
            ], 422);
        }

    }


    public function edit($token)
    {

        $this->checkRepository->getModel()->where('token', $token)->update([ 'status' => 'no aplicado' ]);
        $this->checkExpenseRepository->getModel()->where('check_id',
            $this->checkRepository->token($token)->id)->update([ 'status' => 'no aplicado' ]);

        return response()->json([ 'success' => true ], 200);


    }
}
