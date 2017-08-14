<?php

namespace App\Http\Controllers;

use App\Entities\Departaments\Departament;
use App\Http\Requests\DepartamentCreateRequest;
use App\Traits\DataViewerTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class DepartamentController extends Controller
{
    use DataViewerTraits;

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
        if (Departament::where('name', $data['name'])->count() > 0):
            return response()->json([ 'name' => [ 'El Departamento: '.$data['name'].' ya Existe' ] ],
                422); //return $this->errores();
        endif;
        $data['church_id'] = userChurch()->id;
        $data['budget']=1;
        $data['balance']=0;
        $data['token'] = Crypt::encrypt($data['name']);

        $departament = new Departament();
        $departament->fill($data);
        $departament->save();

        return response()->json([ 'name' => [ 'El Departamento: '.$data['name'].' se registro con Exito' ],'data'=>$departament ],
            200);

    }
}
