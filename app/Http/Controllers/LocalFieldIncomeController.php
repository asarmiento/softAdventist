<?php

namespace App\Http\Controllers;

use App\Entities\LocalFields\BankLocalField;
use App\Entities\LocalFields\CheckICByLF;
use App\Mail\InfosChurchsLocalField;
use App\Notifications\SendLocalFieldInfo;
use App\Repositories\BankLocalFieldRepository;
use App\Repositories\CheckRepository;
use App\Repositories\LocalFieldDespositRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
            $data['number'] = ($data['number']);
            $data['token'] = Crypt::encrypt($data['number']);
            //carbamos la fecha del ck para poder crear la carpeta donde se guardara la imagen
            $date = new Carbon($data['date']);
            //obtenemos el tipo de documento para concatenar la extención
            $type = explode('/', $data['typeCD']);
            $data['image'] = $date->format('M-y').'/'.$data['number'].'-'.$data['bank_local_field_id'].'.'.$type[1];
            $check = $this->checkRepository->token($data['check']['value']);
	
	        $data['balance'] = $check->balance;
	        
            $localFieldDeposit = $this->localFieldDespositRepository->getModel();
            $localFieldDeposit->fill($data);
           
	         
               CheckICByLF::where('check_id',$check->id)->update(['status' => 'aplicado']);
	            $check->update(['status' => 'aplicado']);
               $balanceBank = $localFieldDeposit->bank()->sum('balance') + $data['balance'];
	            BankLocalField::where('id',$localFieldDeposit->bank_local_field_id)->update([ 'balance' => $balanceBank ]);
	            
                //aqui movemos la imagen del cheque de la carpeta temporal a la carpeta del mes
               Storage::move('localFieldDeposit/temp/'.$data['name'], 'localFieldDeposit/'.$data['image']);
	        $localFieldDeposit->image = 'localFieldDeposit/'.$data['balance'];
				
	        if($localFieldDeposit->save()):
		        
		       Mail::to('anwarsarmiento@gmail.com','Anwar Sarmiento')->send(new InfosChurchsLocalField());
                DB::commit();

                return response()->json([
                    'success'  => true,
                    'message'  => 'Se regitro con Exito!!!'
                ], 200);
            else:
                DB::rollback();
              //  return response()->json($churchDeposit->errors, 422);
            endif;
/*##MAIL_DRIVER=smtp
##MAIL_HOST=mail.contadventista.org
##MAIL_PORT=25
##MAIL_USERNAME=info@contadventista.org
##MAIL_PASSWORD=Az&O1tsUG@!2
##MAIL_ENCRYPTION=null*/

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
