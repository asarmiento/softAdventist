<?php

namespace App\Http\Controllers\Church\CheckAndExpenses;

use App\Http\Controllers\Controller;
use App\Repositories\BankRepository;
use App\Repositories\CheckRepository;
use App\Repositories\InternalControlRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

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
     * @var InternalControlRepository
     */
    private $internalControlRepository;


    /**
     * CheckController constructor.
     *
     * @param CheckRepository           $checkRepository
     * @param BankRepository            $bankRepository
     * @param InternalControlRepository $internalControlRepository
     */
    public function __construct(
        CheckRepository $checkRepository,
        BankRepository $bankRepository,
        InternalControlRepository $internalControlRepository
    ) {

        $this->bankRepository = $bankRepository;
        $this->checkRepository = $checkRepository;
        $this->internalControlRepository = $internalControlRepository;
    }


    public function create()
    {
        $banks = $this->bankRepository->listSelects();

        return view('bank.check.create', compact('banks'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        $data = $request->all();
        //verificamos que el numero de ck no exista ya registrado.
        if ($this->checkRepository->getModel()->where('number', $data['number'])->count() > 0):
            return response()->json([ 'name' => [ 'Cuenta Bancaria: '.$data['number'].' ya Existe' ] ],
                422); //return $this->errores();
        endif;
        //obtenemos el id de la cuenta bancaria
        $bank = $this->bankRepository->token($data['bank']['value']);
        //carbamos la fecha del ck para poder crear la carpeta donde se guardara la imagen
        $date = new Carbon($data['date']);
        //obtenemos el tipo de documento para concatenar la extención
        $type = explode('/', $data['typeCk']);
        $data['bank_id'] = $bank->id;
        $data['image'] = $date->format('M-y').'/'.$data['number'].'-'.$data['bank_id'].'.'.$type[1];
        $data['type'] = $data['type']['value'];
        $data['user_id'] = currentUser()->id;
        $data['token'] = Crypt::encrypt($data['number']);
        $check = $this->checkRepository->getModel();
        $check->fill($data);
        if ($check->save()):
            if ($data['controls']) {
                foreach ($data['controls'] as $internal) {
                    $idInternal = $this->internalControlRepository->token($internal['value']);
                    $check->internalControl()->attach($idInternal->id, [
                        'token'   => $check->token,
                        'balance' => $idInternal->balance,
                        'user_id' => currentUser()->id
                    ]);
                }
            }
            //aqui movemos la imagen del cheque de la carpeta temporal a la carpeta del mes
            Storage::move('checks/temp/'.$data['ck'], 'checks/'.$check->image);
            //consultamos el balance de la cuenta y le restamos el ck
            $balance = $check->bank()->sum('balance') - $check->balance;
            //actualizamos el balance de la cuenta bancaria
            $check->bank()->update([ 'balance' => $balance ]);
            DB::commit();

            return response()->json([
                'message' => 'El cheque ha sido registrado: '.$bank->name,
                'list'    => $this->listCheck(),
                'token'   => $check->token,
                'success' => true
            ], 200);
        endif;
        DB::rollback();

        return response()->json($bank->errors, 422);

    }


    public function listCheck()
    {
        return $this->checkRepository->listCheks();
    }


    public function upload(Request $request)
    {
        $file = $request->file('items');
        $name = 'temp'.rand(1, 2000);
        $file->storeAs('checks/temp', $name);

        return response()->json($name, 200);
    }
}
