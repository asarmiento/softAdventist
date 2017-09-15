<?php

namespace App\Http\Controllers;

use App\Repositories\BankLocalFieldRepository;
use App\Repositories\CheckRepository;
use App\Repositories\LocalFieldDespositRepository;
use Illuminate\Http\Request;

class LocalFieldIncomeController extends Controller
{

    /**
     * @var BankLocalFieldRepository
     */
    private $bankLocalFieldRepository;

    /**
     * @var LocalFieldDespositRepository
     */
    private $localFieldDespositRepository;

    /**
     * @var CheckRepository
     */
    private $checkRepository;


    /**
     * LocalFieldIncomeController constructor.
     *
     * @param BankLocalFieldRepository     $bankLocalFieldRepository
     * @param LocalFieldDespositRepository $localFieldDespositRepository
     * @param CheckRepository              $checkRepository
     */
    public function __construct(
        BankLocalFieldRepository $bankLocalFieldRepository,
        LocalFieldDespositRepository $localFieldDespositRepository,
        CheckRepository $checkRepository
    )
    {
        $this->bankLocalFieldRepository = $bankLocalFieldRepository;
        $this->localFieldDespositRepository = $localFieldDespositRepository;
        $this->checkRepository = $checkRepository;
    }


    public function create(){
        return view('church.registerDepositLocalField');
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-08-05
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
    public function store(Request $request)
    {

        $data = $request->all();

        try {

            DB::beginTransaction();
            $bank = $this->bankLocalFieldRepository->getModel()->where('token', $data['bank']['value'])->first();
            if ($this->localFieldDespositRepository->getModel()->where('number', $data['number'])->where('bank_local_field_id',
                    $bank->id)->count() > 0):
                DB::rollback();
                return response()->json([
                    'success' => false,
                    'errors'  => [ 'El Deposito: '.$data['number'].' ya Existe' ]
                ], 422);
            endif;

            $data['bank_local_field_id'] = $bank->id;
            $data['user_id'] = currentUser()->id;
            $data['token'] = Crypt::encrypt($data['number']);
            //carbamos la fecha del ck para poder crear la carpeta donde se guardara la imagen
            $date = new Carbon($data['date']);
            //obtenemos el tipo de documento para concatenar la extención
            $type = explode('/', $data['typeCD']);
            $data['image'] = $date->format('M-y').'/'.$data['number'].'-'.$data['bank_local_field_id'].'.'.$type[1];
            $check = $this->checkRepository->token($data['check']['value']);
            $localFieldDeposit = $this->localFieldDespositRepository->getModel();
            $localFieldDeposit->fill($data);
            if ($localFieldDeposit->save()):
                $totalDeposito = $localFieldDeposit->balance;
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
                    'success'  => false,
                    'message'  => 'Se regitro con Exito!!!',
                    'result'   => $this->internalControlRepository->listPivotSelects(),
                    'deposits' => $this->lists()
                ], 200);
            else:
                DB::rollback();
                return response()->json($churchDeposit->errors, 422);
            endif;


        } catch (Exception $e) {
            echo json_encode($e->getMessage());
            die;
        };

    }

    public function upload(Request $request)
    {
        $file = $request->file('items');
        $name = 'temp'.rand(1, 2000);
        $file->storeAs('localFieldDeposit/temp', $name);

        return response()->json($name, 200);
    }
}
