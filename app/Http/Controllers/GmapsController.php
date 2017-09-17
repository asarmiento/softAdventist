<?php

namespace App\Http\Controllers;

use App\Entities\Church;
use Illuminate\Http\Request;

class GmapsController extends Controller
{
    public function index()
    {
      /*  //configuaración
        $config = array();
        $config['center'] = 'auto';
        $config['map_width'] = 400;
        $config['map_height'] = 400;
        $config['zoom'] = 15;
        $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
 
            });
        }
        centreGot = true;';

        \Gmaps::initialize($config);

        // Colocar el marcador
        // Una vez se conozca la posición del usuario
        $marker = array();
        \Gmaps::add_marker($marker);

        $map = \Gmaps::create_map();*/

      $churches = Church::select('longitud','latitud')->get();
        $churchs = [];
      foreach ($churches AS $church){
         array_push($churchs,['lat'=> $church->latitud, 'lng'=>$church->longitud]);
      }
      if(session('localizacion')) {
          $localizations = session('localizacion');
      }else {
          $localizations = ['latitud'=>'12.385024','longitud'=>'-85.313273'];
      }

        //Devolver vista con datos del mapa
        return view('gmaps', compact('churchs','localizations'));
    }
}
