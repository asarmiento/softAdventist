<?php

namespace App\Http\Controllers;

use App\Entities\InternalControl;
use App\Http\Requests\InternalControlCreateRequest;
use App\Repositories\InternalControlRepository;
use App\Traits\DataViewerTraits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class InternalControlController extends Controller
{
    //
    use DataViewerTraits;
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

    public function index()
    {
        $insternalControls  = $this->internalControlRepository->getModel()->where('church_id',userChurch()->id)->get();
        return view('IncomesAndExpenses.ListInternalControl',compact('insternalControls'));
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: ${DATE}
     * @TimeCreate: $TIME$
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     * * @param Request $request
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return array
     * ----------------------------------------------------------------------
     * *
     */
    public function getData(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        $model = InternalControl::searchPaginateAndOrder($perPage, $request->get('search'));

        $array = $this->myPages($model);

        $columns = InternalControl::$columns;
        $model['per_page'] = $perPage;

        $response = [
            'model'    => $model,
            'columns'  => $columns,
            'my_pages' => $array
        ];

        return $response;
    }

    /**
     * -----------------------------------------------------------------------
     * @Author: Anwar Sarmiento <asarmiento@sistemasamigables.com>
     * @DateCreate: 2017-09-06
     * @TimeCreate: 2:07 pm
     * @DateUpdate: 0000-00-00
     * -----------------------------------------------------------------------
     * @description:
     * @pasos:
     * ----------------------------------------------------------------------
     *
     *  * @var ${TYPE_NAME}
     * * ----------------------------------------------------------------------
     *  * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * ----------------------------------------------------------------------
     * *
     */
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
        //carbamos la fecha del ck para poder crear la carpeta donde se guardara la imagen
        $date = new Carbon($data['saturday']);
        //obtenemos el tipo de documento para concatenar la extención
        $type = explode('/', $data['typeIC']);
        $data['image'] = $date->format('M-y').'/'.$data['number'].'-'.$data['church_id'].'.'.$type[1];

        $internalControl = $this->internalControlRepository->getModel();
        $internalControl->fill($data);
        if($internalControl->save()):
            //aqui movemos la imagen del cheque de la carpeta temporal a la carpeta del mes
            Storage::move('internalControls/temp/'.$data['name'], 'internalControls/'.$internalControl->image);
            return response()->json(['success'=>true, 'message'=>'Se creo con Exito!!!!','token'=>$internalControl->token],200);
        endif;
        return response()->json($internalControl->errors,422);
    }
	public function balanceInfoCheck(Request $request)
	{
		$total =0;
		foreach ($request->all() AS $key => $internal):
			$controls = $this->internalControlRepository->getModel()
				->where('internal_controls.token',$internal['value']);
			
			foreach ($controls->get() AS $control):
				
				if($controls->with('churchDeposit')->count()):
					$churchDeposits = $this->internalControlRepository->sumJoinTablePivotDeposit($control->token);
					
					$total += ($control->localFieldIncome()->sum('balance') - $churchDeposits);
				else:
					$total += $control->localFieldIncome()->sum('balance');
				endif;
			
			endforeach;
		endforeach;
		return response()->json(['balance'=>$total,'success'=>true],200);
	}
	
    public function balanceInfo(Request $request)
    {
        $total =0;
        foreach ($request->all() AS $key => $internal):
            $controls = $this->internalControlRepository->getModel()
                ->where('internal_controls.token',$internal['value']);

            foreach ($controls->get() AS $control):

                if($controls->with('churchDeposit')->count()):
                 
                    $total += ($control->localFieldIncome()->sum('balance'));
                else:
                    $total += $control->localFieldIncome()->sum('balance');
                endif;

            endforeach;
        endforeach;
        return response()->json(['balance'=>$total,'success'=>true],200);
    }

    public function listInfos()
    {
        return $this->internalControlRepository->listPivotSelects();
    }
    public function InfosReport()
    {
        return $this->internalControlRepository->listReportSelects();
    }

    public function InfosSinReport()
    {
        return $this->internalControlRepository->listSinReportSelects();
    }
    public function upload(Request $request)
    {
        $file = $request->file('items');
        $name = 'temp'.rand(1, 2000);
        $file->storeAs('internalControls/temp', $name);

        return response()->json($name, 200);
    }

    public function destroy(Request $request){
        $this->internalControlRepository->find($request->get('id'))->delete();
        return response()->json(['success'=>true,'message'=>'Eliminado con Exito'], 200);
    }
    public function image($month,$name)
    {try {
        return Storage::get('internalControls/'.$month.'/' . $name);
    }catch (\Exception $e){
        echo json_encode($e->getMessage());
        die;
    }
    }
}
