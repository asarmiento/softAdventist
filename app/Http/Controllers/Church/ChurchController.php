<?php
namespace App\Http\Controllers\Church;

use App\Entities\Church;
use App\Entities\Union;
use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateChurchRequest;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Amwar
 * Date: 21/04/2017
 * Time: 05:03 PM
 */
class ChurchController extends Controller
{

    public function create()
    {

        return view('church.create');
    }

    public function newChurch()
    {
        $unions = Union::with('localFields')->get();
        return view('church.create',compact('unions'));
    }

    public function store(CreateChurchRequest $request)
    {
        $data = $request->all();
        $localizacion = explode(',', $data['localizacion']);
            $data['latitud']= substr($localizacion[0],1);
            $data['longitud']= substr($localizacion[1],0,-1);
            $data['name']= trim($data['name']);
            $data['url']= trim($data['name']);
            $data['phone']= '0000-0000';
            $data['email']= trim($data['name']);
            $data['user_id'] = User::where('email','anwarsarmiento@gmail.com')->first()->id;
         if (Church::create($data)){
            session(['localizacion' => $data]);
            return redirect('/iglesias-adventistas')    ;
        }

        return redirect()->back()->withErrors()->withInput();


    }

    public function transfers()
    {
        return view('departament.accounts.TransferAccounts');
    }

    public function listsSelect()
    {
        return Church::listsLabel();
    }

    public function listsSelectCampo()
    {
        return Church::listsLabelCampo();
    }
}
