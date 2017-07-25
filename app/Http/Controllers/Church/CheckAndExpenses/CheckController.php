<?php

namespace App\Http\Controllers\Church\CheckAndExpenses;

use App\Http\Controllers\Controller;
use App\Repositories\BankRepository;
use App\Repositories\CheckRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;

class CheckController extends Controller
{

    /**
     * @var BankRepository
     */
    private $bankRepository;

    /**
     * @var CheckRepository
     */
    private $checkRepository;


    /**
     * CheckController constructor.
     *
     * @param CheckRepository $checkRepository
     * @param BankRepository  $bankRepository
     */
    public function __construct(
        CheckRepository $checkRepository,
        BankRepository $bankRepository)
    {

        $this->bankRepository = $bankRepository;
        $this->checkRepository = $checkRepository;
    }


    public function create()
    {
        $banks = $this->bankRepository->listSelects();
        return view('bank.check.create',compact('banks'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if($this->checkRepository->getModel()->where('number',$data['number'])->count() > 0):
            return response()->json(['name' =>['Cuenta Bancaria: '.$data['number'].' ya Existe']],422); //return $this->errores();
        endif;
        $bank = $this->bankRepository->token($data['bank']['value']);
        $data['bank_id']= $bank->id;
        $data['image']= ".";
        $data['type']= $data['type']['value'];
        $data['user_id']= currentUser()->id;
        $data['token'] = Crypt::encrypt($data['number']);

        $check = $this->checkRepository->getModel();
        $check->fill($data);
        if($check->save()):
            $balance = $check->bank()->sum('balance') - $check->balance ;
            $check->bank()->update(['balance'=>$balance]);
            return response()->json([
                'message'=>'El cheque ha sido registrado: '.$bank->name,
                                     'list'=>$this->listCheck(),
                                     'token'=>$check->token,
                                     'success'=>true],200);
        endif;

            return response()->json($bank->errors,422);

    }

    public function listCheck()
    {
        return $this->checkRepository->filterChurchRelation('bank');
    }

    public function upload(Request $request)
    {
        $file = $request->file('items')[0];
        $file->store('public');
      return response()->json(['successMessagePath'=>true],200);
    }
}
