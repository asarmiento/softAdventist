<?php

namespace App\Http\Controllers\Bank;

use App\Http\Controllers\Controller;
use App\Repositories\BankRepository;
use App\Repositories\ChurchDepositRepository;
use App\Repositories\InternalControlRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ChurchDepositController extends Controller
{

    /**
     * @var BankRepository
     */
    private $bankRepository;

    /**
     * @var ChurchDepositRepository
     */
    private $churchDepositRepository;

    /**
     * @var InternalControlRepository
     */
    private $internalControlRepository;


    /**
     * ChurchDepositController constructor.
     *
     * @param ChurchDepositRepository   $churchDepositRepository
     * @param BankRepository            $bankRepository
     * @param InternalControlRepository $internalControlRepository
     */
    public function __construct(
        ChurchDepositRepository $churchDepositRepository,
        BankRepository $bankRepository,
        InternalControlRepository $internalControlRepository
    ) {
        $this->bankRepository = $bankRepository;
        $this->churchDepositRepository = $churchDepositRepository;
        $this->internalControlRepository = $internalControlRepository;
    }


    public function create()
    {
        $banks = $this->bankRepository->listSelects();

        return view('bank.createChurchDeposit', compact('banks', 'internals'));
    }


    public function store(Request $request)
    {

        $data = $request->all();
        try {
            if (number_format($data['balance'],2,'.','') > number_format($data['total'],2,'.','')):
                return response()->json([
                    'success' => false,
                    'message' => 'El deposito es mayor que los informes seleccionados, debe elegir mas informes'
                ], 422);
            endif;

            DB::beginTransaction();
            $bank = $this->bankRepository->getModel()->where('token', $data['bank_id']['value'])->first();
            if ($this->churchDepositRepository->getModel()->where('number', $data['number'])->where('bank_id',
                    $bank->id)->count() > 0):
                DB::rollback();

                return response()->json([
                    'success' => false,
                    'errors'  => [ 'El Deposito: '.$data['number'].' ya Existe' ]
                ], 422); //return $this->errores();
            endif;

            $data['bank_id'] = $bank->id;
            $data['user_id'] = currentUser()->id;
            $data['token'] = Crypt::encrypt($data['number']);
            //carbamos la fecha del ck para poder crear la carpeta donde se guardara la imagen
            $date = new Carbon($data['date']);
            //obtenemos el tipo de documento para concatenar la extención
            $type = explode('/', $data['typeCD']);
            $data['image'] = $date->format('M-y').'/'.$data['number'].'-'.$data['bank_id'].'.'.$type[1];

            $churchDeposit = $this->churchDepositRepository->getModel();
            $churchDeposit->fill($data);
            if ($churchDeposit->save()):
                $totalDeposito = $churchDeposit->balance;
                foreach ($data['internal_control_id'] AS $key => $internal):
                    $control = $this->internalControlRepository->token($internal['value']);
                    if ($totalDeposito > 0) {
                        $balance = $control->balance;
                        $deposit = $this->internalControlRepository->sumJoinTablePivotDeposit($control->token);
                        if ($deposit > 0) {
                            $balance = ($control->balance - $deposit);
                        }
                        if ($totalDeposito >= $balance) {
                            $totalDeposito -= $balance;
                        } else {
                            $balance = $totalDeposito;
                            $totalDeposito -= $balance;
                        }
                        $churchDeposit->internalControls()->attach($control->id,
                            [ 'balance' => $balance, 'user_id' => currentUser()->id ]);
                    } else {
                        break;
                    }
                endforeach;
                $balanceBank = $churchDeposit->bank()->sum('balance') + $churchDeposit->balance;
                $churchDeposit->bank()->update([ 'balance' => $balanceBank ]);
                //aqui movemos la imagen del cheque de la carpeta temporal a la carpeta del mes
                Storage::move('churchDeposit/temp/'.$data['name'], 'churchDeposit/'.$churchDeposit->image);

                DB::commit();

                return response()->json([
                    'success'  => true,
                    'message'  => 'Se regitro con Exito!!!',
                    'result'   => $this->internalControlRepository->listPivotSelects(),
                    'deposits' => $this->lists()
                ], 200);
            else:
                DB::rollback();

                return response()->json($churchDeposit->errors, 422);
            endif;


        } catch (Exception $e) {

        };
    }


    public function lists()
    {
        return $this->churchDepositRepository->listDeposits();
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: ${DATE}
     * @Time       Create: ${TIME}
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description:
     * @Pasos      :
     *
     * @param Request $request
     * ----------------------------------------------------------------------
     * ----------------------------------------------------------------------
     */
    public function remove(Request $request)
    {
        $data = $request->all();
        $deposit = $this->churchDepositRepository->token($data['token']);
        $balance = $deposit->bank()->sum('balance') - $deposit->balance;
        $deposit->bank()->update([ 'balance' => $balance ]);

        DB::table('church_deposit_internal_control')->where('church_deposit_id', $deposit->id)->delete();
        $this->churchDepositRepository->getModel()->where('id', $deposit->id)->delete();

        return response()->json([ 'exito' ], 200);
    }


    public function upload(Request $request)
    {
        $file = $request->file('items');
        $name = 'temp'.rand(1, 2000);
        $file->storeAs('churchDeposit/temp', $name);

        return response()->json($name, 200);
    }
}
