<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Auth::routes();

Route::get('/confirmation/{token}', ['uses'=>'Auth\RegisterController@confirmation','as'=>'confirmation']);
Route::get('/activation/{email}', ['uses'=>'Auth\RegisterController@activation','as'=>'activation']);
Route::get('iglesia', ['uses'=>'Church\ChurchController@create','as'=>'create-church']);
Route::get('/gmaps', ['as ' => 'gmaps', 'uses' => 'GmapsController@index']);
Route::get('/gmaps1', function(){
    $config = array();
    $config['center'] = 'auto';
    $config['onboundschanged'] = 'if (!centreGot) {
            var mapCentre = map.getCenter();
            marker_0.setOptions({
                position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
            });
        }
        centreGot = true;';

    Gmaps::initialize($config);

    // set up the marker ready for positioning
    // once we know the users location
    $marker = array();
    Gmaps::add_marker($marker);

    $map = Gmaps::create_map();
    echo "<html><head><script type='text/javascript'>var centreGot = false;</script>".$map['js']."</head><body>".$map['html']."</body></html>";
});

Route::group(['prefix'=>'registrado','middleware'=>'auth'],function (){

    Route::get('test/index', ['uses'=>'TestController@index','as'=>'test']);
    Route::get('test/pendiente', ['uses'=>'TestController@pendiente','as'=>'pendiente']);
    Route::get('test/ver', ['uses'=>'TestController@ver','as'=>'test']);
    Route::get('test/mensaje', ['uses'=>'TestController@message','as'=>'test-mensaje']);
    Route::get('inscription', ['uses'=>'HomeController@create','as'=>'home']);
    Route::get('perfil', ['uses'=>'HomeController@profile','as'=>'profile']);
    Route::get('pdf', ['uses'=>'HomeController@pdf','as'=>'pdf']);
    Route::get('excel', ['uses'=>'HomeController@excelList','as'=>'excelList']);
    Route::get('status/{id}', ['uses'=>'HomeController@status','as'=>'status-change']);
    Route::get('lista-de-inscriptos', ['uses'=>'HomeController@lists','as'=>'lists-inscription']);
    Route::post('inscription', ['uses'=>'HomeController@store','as'=>'save-inscription']);
    Route::post('registered', ['uses'=>'HomeController@registered','as'=>'save-registered']);


});

    Route::group(['prefix'=>'tesoreria','middleware'=>['auth','cont']],function (){
    //miembros
    Route::get('nuevo-miembros', ['uses'=>'MemberController@create','as'=>'new-member']);
    Route::get('cobro-a-miembros', ['uses'=>'MemberController@charge','as'=>'charge-members']);
    Route::post('save-miembros', 'MemberController@store');
    Route::get('lista-miembros', ['uses'=>'MemberController@index','as'=>'list-members']);
        /**
         * Departamentos
         */
        Route::get('crear-departamento', ['uses'=>'DepartamentController@create','as'=>'create-departament']);
        Route::post('save-departament', 'DepartamentController@store');
        /**
         * Ingresos
         */
        Route::get('registrar-ingresos', ['uses'=>'IncomeAccountController@create','as'=>'create-incomes']);
        Route::post('save-incomes', 'IncomeAccountController@store');
        /**
         * Gastos
         */
        Route::get('registrar-gastos', ['uses'=>'ExpenseAccountController@create','as'=>'create-expenses']);
        Route::post('save-expense', 'ExpenseAccountController@store');

    Route::get('lista-miembro1s', ['uses'=>'MemberController@index','as'=>'charge-members']);
    Route::get('lista-miembros1', ['uses'=>'MemberController@index','as'=>'list-departament']);
    Route::get('lista-miembros11', ['uses'=>'MemberController@index','as'=>'change-status']);
    Route::get('lista-miembro3s', ['uses'=>'MemberController@index','as'=>'create-cta-ing']);
    Route::get('lista-miembro4s', ['uses'=>'MemberController@index','as'=>'list-cta-gto']);
    Route::get('lista-miembro5s', ['uses'=>'MemberController@index','as'=>'list-info-month']);
    Route::get('lista-miembro6s', ['uses'=>'MemberController@index','as'=>'list-info-week']);


});
