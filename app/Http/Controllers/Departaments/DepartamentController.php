<?php

namespace App\Http\Controllers\Departaments;

use App\Entities\Departaments\Departament;
use App\Entities\Departaments\ListDepartament;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartamentCreateRequest;
use App\Repositories\Church\Departaments\ListDepartamentRepository;
use App\Traits\DataViewerTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class DepartamentController extends Controller
{

    use DataViewerTraits;

    /**
     * @var ListDepartamentRepository
     */
    private $listDepartamentRepository;


    /**
     * DepartamentController constructor.
     *
     * @param ListDepartamentRepository $listDepartamentRepository
     */
    public function __construct(ListDepartamentRepository $listDepartamentRepository)
    {
        $this->listDepartamentRepository = $listDepartamentRepository;
    }


    public function index()
    {

        return view('departament.listsDepartaments');
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-08-27
     * @Time       Create: 5:38pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description: Mostramos la vista para asignarle un departamento a la
     *             iglesias
     * @Pasos      :
     * ----------------------------------------------------------------------
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * ----------------------------------------------------------------------
     */
    public function create()
    {
        return view('departament.create');
    }


    public function getData(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        $model = Departament::searchPaginateAndOrder($perPage, $request->get('search'),
            true)->with('listDepartament')->paginate($perPage);

        $array = $this->myPages($model);

        $columns = Departament::$columns;

        $response = [
            'model'    => $model,
            'columns'  => $columns,
            'my_pages' => $array
        ];

        return $response;
    }


    public function inactiveDep(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        $model = Departament::searchPaginateAndOrder($perPage, $request->get('search'),
            true)->with('incomeAccounts')->with('listDepartament')->where('status', 'inactivo')->paginate($perPage);
        $count = Departament::where('status', 'inactivo')->where('church_id',
            userChurch()->id)->sum('percent_of_budget');
        $array = $this->myPages($model);

        $columns = Departament::$columns;

        $response = [
            'model'    => $model,
            'columns'  => $columns,
            'my_pages' => $array,
            'count'    => $count
        ];

        return $response;
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-08-27
     * @Time       Create: 5:13pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description: Aqui relacionamos un departamento con una iglesia
     *             y le ponemos el presupuesto que esta asignado.
     * @Pasos      : 1. verificamos si el departamentos existe
     *             2.
     *
     * @param DepartamentCreateRequest $request
     * ----------------------------------------------------------------------
     *
     * @return \Illuminate\Http\JsonResponse
     * ----------------------------------------------------------------------
     */
    public function store(DepartamentCreateRequest $request)
    {
        $data = $request->all();
        $newDepartamen = $this->listDepartamentRepository->token($data['name']['value']);
        if (Departament::where('list_departament_id', $newDepartamen->id)->count() > 0):
            return response()->json([ 'errors' => [ 'El Departamento: '.$newDepartamen->name.' ya Existe' ] ], 422);
        endif;
        $data['church_id'] = userChurch()->id;
        $data['budget'] = $data['percent_of_budget'];
        $data['balance'] = $data['percent_of_budget'];
        $data['status'] = 'desactivo';
        $data['authorized'] = 'no';
        $data['list_departament_id'] = $newDepartamen->id;
        $data['token'] = Crypt::encrypt($newDepartamen->name);

        $departament = new Departament();
        $departament->fill($data);
        if ($departament->save()) {
            return response()->json([
                'message' => 'El Departamento: '.$newDepartamen->name.' se registro con Exito',
                'dep'    => Departament::searchPaginateAndOrder(10, $request->get('search'),
                    true)->with('incomeAccounts')->with('listDepartament')->where('status', 'inactivo')->paginate(10)
            ], 200);
        }

        return response()->json([ 'errors' => [ 'El Departamento: '.$newDepartamen->name.' no se pudo registrar' ] ],
            422);
    }


    /**
     * ---------------------------------------------------------------------
     * @Author     : Anwar Sarmiento "asarmiento@sistemasamigables.com"
     * @Date       Create: 2017-08-24
     * @Time       Create: 3:19pm
     * @Date       Update: 0000-00-00
     * ---------------------------------------------------------------------
     * @Description: Obtenemos la lista de los departamentos que puede tener
     *             una iglesia para que los puedan elegir los que cada
     *             iglesia utilizaria en su tesoreria.
     * @Pasos      :
     * ----------------------------------------------------------------------
     * @return array
     * ----------------------------------------------------------------------
     */
    public function listDepartament()
    {
        return $this->listDepartamentRepository->listSelectsSinFilterChurch();
    }


    public function remove(Request $request)
    {
        $departament = Departament::find($request->get('id'))->delete();
        if ($departament) {
            return response()->json([
                'message' => 'Se elimino con exito',
                'success' => true
            ], 200);
        }

        return response()->json([ 'errors' => [ 'El Departamento tiene cuentas de ingreso y salidas ligadas, no se pudo registrar' ] ],
            422);
    }
}
