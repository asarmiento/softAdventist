<?php

namespace App\Http\Controllers;

use App\Entities\InternalControl;
use App\Http\Requests\InternalControlCreateRequest;
use App\Repositories\InternalControlRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InternalControlController extends Controller
{
    //

    /**
     * @var InternalControlRepository
     */
    private $internalControlRepository;


    /**
     * InternalControlController constructor.
     *
     * @param InternalControlRepository $internalControlRepository
     */
    public function __construct(InternalControlRepository $internalControlRepository)
    {

        $this->internalControlRepository = $internalControlRepository;
    }
    public function create()
    {
        $insternalControls = InternalControl::all();
        return view('IncomesAndExpenses.createInternalControl',compact('insternalControls'));
    }

    public function store(InternalControlCreateRequest $request)
    {
        $data = $request->all();
        $data['token'] = Crypt::encrypt($data['number'].$data['saturday']);
        $data['church_id'] = 1;

        $internalControl = $this->internalControlRepository->getModel();
        $internalControl->fill($data);
        if($internalControl->save()):
                return response()->json(['success'=>true, 'message'=>'Se creo con Exito!!!!','token'=>$internalControl->token],200);
        endif;
        return response()->json($internalControl->errors,422);
    }

    public function balanceInfo(Request $request)
    {
        $total =0;
        foreach ($request->all() AS $key => $internal):
            $controls = $this->internalControlRepository->getModel()
                ->where('internal_controls.token',$internal['value']);
            foreach ($controls->get() AS $control):
                if($controls->with('churchDeposit')->count()):
                    $churchDeposits = $this->internalControlRepository->sumJoinTablePivotDeposit($control->token);

                    $total += ($control->balance - $churchDeposits);
                else:
                    $total += $control->balance;
                endif;

            endforeach;
        endforeach;
        return response()->json(['balance'=>$total,'success'=>true],200);
    }

    public function listInfos()
    {
        return $this->internalControlRepository->listPivotSelects();
    }
}
