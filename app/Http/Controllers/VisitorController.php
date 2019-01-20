<?php
/**
 * Created by PhpStorm.
 * User: Anwar
 * Date: 30/12/2018
 * Time: 10:06:AM
 */

namespace App\Http\Controllers;


use App\Entities\Assistance;
use App\Entities\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index()
    {
        return view('visitor.index');
    }
    public function getData(Request $request)
    {
        $perPage = 10;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }

        $model = Visitor::where('church_id', userChurch()->id)->searchPaginateAndOrder($perPage, $request->get('search'));

        $array = $this->myPages($model);

        $columns = Visitor::$columns;
        $model['per_page'] = $perPage;

        $response = [
            'model' => $model,
            'columns' => $columns,
            'my_pages' => $array
        ];
        return $response;
    }
    public function create()
    {
        return view('visitor.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['date'] = Carbon::now()->toDateString();
        $data['user_id']= currentUser()->id;
        
        $pray_request = $data['pray_request'];
        $visitor = new Visitor();
        $visitor->fill($data);
        if($visitor->save()){
            $data = [];
            $data['pray_request'] = $pray_request;
            $data['date'] = Carbon::now()->toDateString();
            $data['time'] = Carbon::now()->toTimeString();
            $data['liturgia'] = 0;
            $data['visitor_id'] = $visitor->id;
            $data['user_id'] = currentUser()->id;
            $data['church_id'] = userChurch()->id;
            if($data['time'] > '10:30'){
                $data['liturgia'] = 1;
            }

            $assits = new Assistance();
            $assits->fill($data);
            if($assits->save()){
                return response()->json(['success'=>true,'datos'=>$this->listAssits()],200);
            }
            return response()->json(['success'=>true],200);
        }
    }

    public function storeAssits(Request $request)
    {
        $data = $request->all();

        $data['date'] = Carbon::now()->toDateString();
        $data['time'] = Carbon::now()->toTimeString();
        $data['liturgia'] = 0;
        $data['member_id'] = $data['assists']['value'];
        $data['user_id'] = currentUser()->id;
        if($data['time'] > '10:30'){
            $data['liturgia'] = 1;
        }


        $assits = new Assistance();
        $assits->fill($data);
        if($assits->save()){
            return response()->json(['success'=>true,'datos'=>$this->listAssits()],200);
        }

    }

    public function listAssits()
    {

        return Assistance::with('member','visitor')->whereHas('member',function ($q){
            $q->where('church_id',userChurch()->id);
        })->where('date',Carbon::now()->toDateString())->get();
    }
    public function listAssitsVisitor()
    {

        return Assistance::with('member','visitor')->whereHas('visitor',function ($r){
            $r->orWhere('church_id',userChurch()->id);
        })->where('date',Carbon::now()->toDateString())->get();
    }
}
