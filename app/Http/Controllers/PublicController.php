<?php


namespace App\Http\Controllers;


use App\Entities\Church;
use App\Traits\DataViewerTraits;
use Illuminate\Http\Request;

class PublicController extends Controller
{
use DataViewerTraits;
    public function getDataMemberClubPublic(Request $request)
    {
        $perPage = 50;
        if ($request->has('perPage')) {
            $perPage = $request->perPage;
        }



        $model = Church::with('membersC.memberClub.club')
            ->whereHas('membersC.memberClub')->search($request->get('search'))->paginate($perPage);

        $campo = true;



        $array = $this->myPages($model);

        $columns = [];
        $model['per_page'] = $perPage;

        $response = [
            'model' => $model,
            'columns' => $columns,
            'my_pages' => $array,
            'campo' => $campo
        ];
        return $response;
    }

    public function memberPublic()
    {
         return view('clubes.ListProfilePublic');
    }
}
