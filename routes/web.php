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
Route::get('home', ['uses'=>'HomeController@index','as'=>'home']);
Route::get('manual-de-usuario', ['uses'=>'HomeController@help','as'=>'help']);

Route::get('/verification/{token}', ['uses'=>'Auth\RegisterController@verificacion','as'=>'verificacion']);
Route::get('/activation/{email}', ['uses'=>'Auth\RegisterController@activation','as'=>'active']);
Route::get('contacto', ['uses'=>'Auth\RegisterController@contact','as'=>'contact']);
Route::post('contacto', ['uses'=>'Auth\RegisterController@contactPost','as'=>'contacto']);
/*Route::get('iglesia', ['uses'=>'Church\ChurchController@create','as'=>'create-church']);

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
*/
    Route::group(['prefix'=>'tesoreria','middleware'=>'auth'],function (){

        Route::get('/', 'HomeController@index');
        Route::get('home', ['uses'=>'HomeController@index','as'=>'home']);
        Route::get('profile', ['uses'=>'HomeController@index','as'=>'profile']);
        //miembros
        Route::get('nuevo-miembros', ['uses'=>'MemberController@create','as'=>'profile']);
        Route::get('nuevo-miembros', ['uses'=>'MemberController@create','as'=>'new-member']);
        Route::get('cobro-a-miembros', ['uses'=>'MemberController@charge','as'=>'charge-members']);
        Route::post('save-miembros', 'MemberController@store');
        Route::get('lista-miembros', ['uses'=>'MemberController@index','as'=>'list-members']);
        Route::get('lista-miembros-deuda', ['uses'=>'MemberController@index','as'=>'list-members-due']);
        Route::get('lists-miembros', ['uses'=>'MemberController@getData','as'=>'listMembers']);
        /**
         * Departamentos
         */
        Route::get('crear-departamento', ['uses'=>'DepartamentController@create','as'=>'create-departament']);
        Route::get('movimientos-departamento', ['uses'=>'DepartamentController@create','as'=>'move-departaments']);
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
        Route::post('upload-internal-control', 'InternalControlController@upload');
        Route::post('delete-internal-control', 'InternalControlController@destroy');
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
        Route::get('crear-account-gastos', ['uses'=>'Church\CheckAndExpenses\ExpenseAccountController@create','as'=>'create-expenses']);
        Route::post('save-expense', 'Church\CheckAndExpenses\ExpenseAccountController@store');

        Route::get('registro-de-gastos', ['uses'=>'Church\CheckAndExpenses\CheckExpenseAccountController@create','as'=>'register-expenses']);
        Route::get('registro-detalle-cheque/{token}', 'Church\CheckAndExpenses\CheckExpenseAccountController@createCheck');
        Route::get('lista-de-gastos-not/{check}', 'Church\CheckAndExpenses\CheckExpenseAccountController@balanceNot');
        Route::get('balance-de-gastos-not', 'Church\CheckAndExpenses\CheckExpenseAccountController@balanceNotC');
        Route::get('lista-de-gastos', 'Church\CheckAndExpenses\CheckExpenseAccountController@listsAplicado');
        Route::get('lista-de-todos-los-gastos', ['uses'=>'Church\CheckAndExpenses\CheckExpenseAccountController@lists','as'=>'list-expenses']);
        Route::post('save-expense-invoice', 'Church\CheckAndExpenses\CheckExpenseAccountController@store');
        Route::post('finish-expense-invoice', 'Church\CheckAndExpenses\CheckExpenseAccountController@finish');
        Route::get('edit-expense-invoice/{token}', 'Church\CheckAndExpenses\CheckExpenseAccountController@edit');
        Route::post('remove', 'Church\CheckAndExpenses\CheckExpenseAccountController@destroy');
        /**
         * Cheques
         */
        Route::get('registro-de-cheques', ['uses'=>'Church\CheckAndExpenses\CheckController@create','as'=>'create-check']);
        Route::get('lista-de-cheques', ['uses'=>'Church\CheckAndExpenses\CheckController@listCheck','as'=>'list-check']);
        Route::post('save-check', 'Church\CheckAndExpenses\CheckController@store');
        Route::post('upload-check', 'Church\CheckAndExpenses\CheckController@upload');
        Route::post('delete-check', 'Church\CheckAndExpenses\CheckController@destroy');

        Route::get('lista-miembro1s', ['uses'=>'MemberController@index','as'=>'charge-members']);
        Route::get('lista-miembros1', ['uses'=>'MemberController@index','as'=>'list-departament']);
        Route::get('lista-miembros11', ['uses'=>'MemberController@index','as'=>'change-status']);
        Route::get('lista-miembro3s', ['uses'=>'MemberController@index','as'=>'create-cta-ing']);
        Route::get('lista-miembro4s', ['uses'=>'MemberController@index','as'=>'list-cta-gto']);
        Route::get('lista-miembro6s', ['uses'=>'MemberController@index','as'=>'list-info-week']);
        //Reportes
        Route::get('reporte-semanal/{date}', ['uses'=>'ReportPdfController@infoSemanal','as'=>'reportWeekly']);
        Route::get('pdf-de-gastos/{token}', 'ReportPdfController@checkDetail');
        Route::get('reporte-estado-de-cuenta-actual/{token}', 'ReportPdfController@stateAccountNow');


    });
