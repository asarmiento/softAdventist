<?php

namespace App\Http\Controllers;

use App\Entities\Departament;
use App\Http\Requests\DepartamentCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class DepartamentController extends Controller
{
    //
    public function create()
    {
        return view('departament.create');
    }

    public function store(DepartamentCreateRequest $request)
    {
        $data = $request->all();
        if(Departament::where('name',$data['name'])->count() > 0):
            return response()->json(['name' =>['El Departamento: '.$data['name'].' ya Existe']],422); //return $this->errores();
        endif;
            $data['church_id']= 1;
            $data['budget']= '1';
            $data['token'] = Crypt::encrypt($data['name']);

                $departament = new Departament();
                $departament->fill($data);
                $departament->save();
                return $this->exito('El Departamento: '.$departament->name);

    }
}
