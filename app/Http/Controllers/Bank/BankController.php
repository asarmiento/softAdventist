<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBankRequest;
use App\Repositories\BankRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class BankController extends Controller
{
    //

    /**
     * @var BankRepository
     */
    private $bankRepository;


    public function __construct(BankRepository $bankRepository)
    {
        $this->bankRepository = $bankRepository;
    }


    public function create()
    {
        $banks = $this->bankRepository->filterChurchs();
        return view('bank.create',compact('banks'));
    }

    public function store(CreateBankRequest $request)
    {
        $data = $request->all();
        if($this->bankRepository->getModel()->where('code',$data['code'])->count() > 0):
            return response()->json(['name' =>['Cuenta Bancaria: '.$data['code'].' ya Existe']],422); //return $this->errores();
        endif;
        $data['church_id']= 1;
        $data['balance']= $data['initial_balance'];
        $data['user_id']= currentUser()->id;
        $data['token'] = Crypt::encrypt($data['name']);

        $bank = $this->bankRepository->getModel();
        $bank->fill($data);
        $bank->save();
        return $this->exito('La Cuenta Bancaria: '.$bank->name);

    }
}
