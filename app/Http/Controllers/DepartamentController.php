<?php

namespace App\Http\Controllers;

use App\Entities\Departaments\Departament;
use App\Entities\Departaments\ListDepartament;
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


    public function __construct(ListDepartamentRepository $listDepartamentRepository)
    {
        $this->listDepartamentRepository = $listDepartamentRepository;
        $this->middleware('admin')->only('create');
    }


    public function index(){
        return view('departament.listsDepartaments');
    }

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

        $model = Departament::searchPaginateAndOrder($perPage, $request->get('search'));

        $array = $this->myPages($model);

        $columns = Departament::$columns;

        $response = [
            'model'    => $model,
            'columns'  => $columns,
            'my_pages' => $array
        ];

        return $response;
    }


    public function store(DepartamentCreateRequest $request)
    {
        $data = $request->all();
        $newDepartamen = $this->listDepartamentRepository->token($data['name']['value']);
        if (Departament::where('list_departament_id', $newDepartamen->id)->count() > 0):
            return response()->json([ 'name' => [ 'El Departamento: '.$newDepartamen->name.' ya Existe' ] ],
                422); //return $this->errores();
        endif;
        $data['church_id'] = userChurch()->id;
        $data['budget']=$data['percent_of_budget'];
        $data['balance']=0;
        $data['list_departament_id']=$newDepartamen->id;
        $data['token'] = Crypt::encrypt($data['name']['name']);

        $departament = new Departament();
        $departament->fill($data);
        if($departament->save()) {

            return response()->json([
                'name' => [ 'El Departamento: '.$newDepartamen->name.' se registro con Exito' ],
                'data' => $departament
            ], 200);
        }
        return response()->json([ 'name' => [ 'El Departamento: '.$newDepartamen->name.' no se pudo registrar' ] ],
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
}
