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

    Route::group(['prefix'=>'tesoreria','middleware'=>['auth']],function (){

        //miembros
        Route::get('/', 'HomeController@index');
        Route::get('home', ['uses'=>'HomeController@index','as'=>'home']);
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
         * Cuentas Bancarias
         */
        Route::get('cuentas-bancarias', ['uses'=>'Bank\BankController@create','as'=>'create-bank']);
        Route::post('save-bank', 'Bank\BankController@store');


        Route::get('depositos-de-la-iglesia', ['uses'=>'Bank\ChurchDepositController@create','as'=>'register-deposit']);
        Route::get('lista-depositos', ['uses'=>'Bank\ChurchDepositController@lists','as'=>'list-deposit']);
        Route::post('save-church-deposit', 'Bank\ChurchDepositController@store');
        Route::post('remove-deposit', 'Bank\ChurchDepositController@remove');
        /**
         * Ingresos
         */
        Route::get('registrar-ingresos', ['uses'=>'IncomeAccountController@create','as'=>'create-incomes']);
        Route::post('save-incomes', 'IncomeAccountController@store');
        //controles internos
        Route::get('registro-control-interno', ['uses'=>'InternalControlController@create','as'=>'create-internal-control']);
        Route::post('save-internal-control', 'InternalControlController@store');
        Route::get('lista-info-sin-deposito', ['uses'=>'InternalControlController@listInfos','as'=>'list-infos-sin-deposito']);



        Route::post('balance-internal-control', 'InternalControlController@balanceInfo');
        Route::get('registro-de-ingresos/{token}', ['uses'=>'WeeklyIncomeController@create','as'=>'registro-de-ingresos']);
        Route::post('save-register-incomes', 'InternalControlController@store');
        Route::post('save-weekly-incomes', 'WeeklyIncomeController@store');
        Route::post('finish-info-income', 'WeeklyIncomeController@finish');
        Route::get('check-finish-info', 'WeeklyIncomeController@checkFinishInfo');
        Route::get('list-member-weekly', 'MemberController@listMemberInfo');
        Route::get('lista-de-informes', ['uses'=>'IncomeAccountController@index','as'=>'list-info-weekly']);
        //temporales
        Route::post('save-campo-temp-income', 'TempLocalFieldIncomeController@store');
        Route::post('remove-campo-temp-income', 'TempLocalFieldIncomeController@remove');
        Route::post('save-iglesia-temp-income', 'TempIncomesController@store');
        Route::post('remove-iglesia-temp-income', 'TempIncomesController@remove');
        Route::post('remove-line-income', 'WeeklyIncomeController@removeLine');

        /**
        * Gastos
        */
        Route::get('registrar-gastos', ['uses'=>'ExpenseAccountController@create','as'=>'create-expenses']);
        Route::post('save-expense', 'ExpenseAccountController@store');
        /**
         * Cheques
         */
        Route::get('registro-de-cheques', ['uses'=>'Church\CheckAndExpenses\CheckController@create','as'=>'create-check']);
        Route::get('lista-de-cheques', ['uses'=>'Church\CheckAndExpenses\CheckController@listCheck','as'=>'list-check']);
        Route::post('save-check', 'Church\CheckAndExpenses\CheckController@store');

        Route::get('lista-miembro1s', ['uses'=>'MemberController@index','as'=>'charge-members']);
        Route::get('lista-miembros1', ['uses'=>'MemberController@index','as'=>'list-departament']);
        Route::get('lista-miembros11', ['uses'=>'MemberController@index','as'=>'change-status']);
        Route::get('lista-miembro3s', ['uses'=>'MemberController@index','as'=>'create-cta-ing']);
        Route::get('lista-miembro4s', ['uses'=>'MemberController@index','as'=>'list-cta-gto']);
        Route::get('lista-miembro6s', ['uses'=>'MemberController@index','as'=>'list-info-week']);
        //Reportes
        Route::get('reporte-semanal/{date}', ['uses'=>'ReportPdfController@infoSemanal','as'=>'reportWeekly']);


    });
