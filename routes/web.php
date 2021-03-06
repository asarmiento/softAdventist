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
*

Route::get('/', function () {
    return view('auth.login');
});*/
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/ja', function () {
    return view('auth.loginJa');
});

Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');


Route::get('/google954bee1fab08d971.html', function () {
    return view('google954bee1fab08d971.html');
});

Route::get('/iglesias-adventistas', 'GmapsController@index');
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Auth::routes();
Route::get('home', ['uses' => 'HomeController@index', 'as' => 'home']);
Route::get('manual-de-usuario', ['uses' => 'HomeController@help', 'as' => 'help']);

Route::get('/verification/{token}', ['uses' => 'Auth\RegisterController@verificacion', 'as' => 'verificacion']);
Route::get('/activation/{email}', ['uses' => 'Auth\RegisterController@activation', 'as' => 'active']);
Route::get('contacto', ['uses' => 'Auth\RegisterController@contact', 'as' => 'contact']);
Route::post('contacto', ['uses' => 'Auth\RegisterController@contactPost', 'as' => 'contacto']);
Route::get('test/update-income', ['uses' => 'TestController@updateIncome', 'as' => 'test']);
//Route::get('iglesia', ['uses'=>'Church\ChurchController@create','as'=>'create-church']);

Route::group(['prefix' => 'registrado', 'middleware' => 'auth'], function () {
    /*
        Route::get('test/index', ['uses'=>'TestController@updateIncome','as'=>'test']);
        Route::get('test/pendiente', ['uses'=>'TestController@pendiente','as'=>'pendiente']);
        Route::get('test/ver', ['uses'=>'TestController@ver','as'=>'test']);
        Route::get('test/mensaje', ['uses'=>'TestController@message','as'=>'test-mensaje']);
        Route::get('inscription', ['uses'=>'HomeController@create','as'=>'home']);
        Route::get('perfil', ['uses'=>'HomeController@profile','as'=>'profile']);
        Route::get('pdf', ['uses'=>'HomeController@pdf','as'=>'pdf']);
        Route::get('excel', ['uses'=>'HomeController@excelList','as'=>'excelList']);
        Route::get('status/{id}', ['uses'=>'HomeController@status','as'=>'status-change']);
         Route::post('inscription', ['uses'=>'HomeController@store','as'=>'save-inscription']);
    */

    Route::get('lista-de-inscriptos', ['uses' => 'HomeController@lists', 'as' => 'lists-inscription']);
    Route::get('update-de-lunch/{id}', ['uses' => 'HomeController@updatelaunch', 'as' => 'update-inscription']);
    Route::post('registered/boys', ['uses' => 'HomeController@registered', 'as' => 'save-registered']);
    Route::post('delete/boys', ['uses' => 'HomeController@delete', 'as' => 'delete-registered']);
    Route::post('upload/boys', ['uses' => 'HomeController@upload', 'as' => 'upload-registered']);

});


Route::get('nueva-iglesia', ['uses' => 'Church\ChurchController@newChurch', 'as' => 'new-church']);
Route::post('nueva-iglesia', ['uses' => 'Church\ChurchController@store', 'as' => 'store-church']);
Route::get('paises', ['uses' => 'CountryController@index', 'as' => 'country']);
Route::get('list-localfields-all', ['uses' => 'LocalField\LocalFieldController@index', 'as' => 'union']);
Route::get('list-unions-country/{token}', ['uses' => 'UnionController@index', 'as' => 'country']);
Route::post('save-church-public', ['uses' => 'Church\ChurchController@store', 'as' => 'save-church-public']);
/**
 * Publicas rutas
 */

Route::get('data-member-tarjetas-public', 'PublicController@getDataMemberClubPublic');
Route::get('lista-conquistadores-y-guias-mayores', 'PublicController@memberPublic');

Route::group(['prefix' => 'softadventist', 'middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index');
    Route::get('/image/{type}/{month}/{name}', 'HomeController@image');
    Route::get('home', ['uses' => 'HomeController@index', 'as' => 'home']);
    //   Route::get('profile', ['uses'=>'HomeController@index','as'=>'profile']);
    //miembros
    //   Route::get('perfil-user', ['uses'=>'MemberController@create','as'=>'profile']);
    Route::get('nuevo-miembros', ['uses' => 'MemberController@create', 'as' => 'new-member']);
    Route::get('modificar-miembro/{id}', ['uses' => 'MemberController@edit', 'as' => 'edit-member']);
    Route::get('cobro-a-miembros', ['uses' => 'MemberController@charge', 'as' => 'charge-members']);
    Route::post('save-miembros', 'MemberController@store');
    Route::post('update-miembros', 'MemberController@update');
    Route::get('lista-miembros', ['uses' => 'MemberController@index', 'as' => 'list-members']);
    Route::get('lista-miembros-deuda', ['uses' => 'MemberController@index', 'as' => 'list-members-due']);
    Route::get('lists-miembros', ['uses' => 'MemberController@getData', 'as' => 'listMembers']);
    Route::get('lista-miembros-select', 'MemberController@selectMembers');
    Route::get('lista-miembros-select-campo', 'MemberController@selectMembersCampo');
    /**
     * Visitantes
     */
    Route::get('asistencia-miembros-en-cultos', 'MemberController@assistance')->name('asistencia-member');
    Route::get('nuevo-visitas', 'VisitorController@create')->name('new-visitor');
    Route::post('save-visitor', 'VisitorController@store');
    Route::post('save-assists', 'VisitorController@storeAssits');
    Route::get('lista-visitas', 'VisitorController@index')->name('list-visitor');
    Route::get('list-visitor', 'MemberController@getData');
    Route::get('lista-asistencia', 'VisitorController@listAssits');
    Route::get('lista-asistencia-visitas', 'VisitorController@listAssitsVisitor');
    /**
     * clubes
     */
    Route::get('lista-perfiles-clubes', 'ClubesController@listProfile')->name('list-ja');
    Route::get('lista-perfiles-pastores', 'ClubesController@listProfilePastor')->name('list-ja-pastor');
    Route::get('perfile-clubes', 'ClubesController@profile')->name('profile');
    Route::get('perfile-especialidades/{id}', 'ClubesController@profileSpecialty');
    Route::get('lista-director-select', 'ClubesController@listDirector');
    Route::get('data-directores', 'ClubesController@dataDirectores');
    Route::get('lista-club-select', 'ClubesController@listClubes');
    Route::get('lista-tarjetas-select', 'ClubesController@listClubCard');
    Route::get('data-member-tarjetas', 'ClubesController@getDataMemberClub');
    Route::get('data-pastores-tarjetas', 'ClubesController@getDataPastoresClub');
    Route::get('registrar-directores-de-clubes', 'ClubesController@registerClubDirector')->name('register-club-director');
    Route::post('store-directores-de-clubes', 'ClubesController@storeDirector');
    Route::post('save-miembros-card-club', 'ClubesController@storeMemberCard');
    Route::post('save-miembros-card-club-aventureros', 'ClubesController@storeMemberCardAventureros');
    Route::post('save-miembros-card-club-guia', 'ClubesController@storeMemberCardGuiaLider');
    Route::post('save-especiality-member', 'ClubesController@storeSpeciality');
    Route::get('registrar-tarjetas-a-jovenes', 'ClubesController@registerCards')->name('register-card-ja');
    Route::get('registrar-tarjetas-a-aventureros', 'ClubesController@registerCardsAventureros')->name('register-card-aventurero');
    Route::get('registrar-tarjetas-a-jovenes-guia-lider', 'ClubesController@registerCardsGMLJ')->name('register-card-gm-lj');
    Route::get('registrar-especialidades-a-jovenes', 'ClubesController@registerSpecialties')->name('register-specialties-ja');
    Route::get('registrar-especialidades', 'ClubesController@registerNewSpecialties')->name('register-specialidades-ja');
    Route::get('code-liderjuvenil', 'ClubesController@codeLiderJuvenil');
    Route::get('lista-de-imagenes', 'ClubesController@listFiles');
    Route::get('lista-de-especialidades-select', 'ClubesController@listSpecialties');
    Route::get('lista-de-instructores-select', 'ClubesController@listInstructores');
    Route::get('datos-user-connet', 'UserController@userData');
    /**
     * Departamentos
     */
    Route::get('lista-de-departamentos', 'Departaments\DepartamentController@listDepartament');
    Route::get('lista-de-departamentos-select', 'Departaments\DepartamentController@listDepartamentsSelect');
    Route::get('crear-departamento', ['uses' => 'Departaments\DepartamentController@create', 'as' => 'create-departament']);
    Route::get('lista-departament', ['uses' => 'Departaments\DepartamentController@index', 'as' => 'lists-departament']);
    Route::get('lists-departament', 'Departaments\DepartamentController@getData');
    Route::get('lists-departament-inactive', 'Departaments\DepartamentController@inactiveDep');
    Route::get('movimientos-departamento', ['uses' => 'Departaments\DepartamentController@create', 'as' => 'move-departaments']);
    Route::post('delete-departament', 'Departaments\DepartamentController@remove');
    Route::post('save-departament', 'Departaments\DepartamentController@store');
    Route::post('applied-departament', 'Departaments\DepartamentController@applied');
    /**
     * Cuentas Bancarias
     */
    Route::get('cuentas-bancarias', ['uses' => 'Bank\BankController@create', 'as' => 'create-bank']);
    Route::post('save-bank', 'Bank\BankController@store');
    /**
     * Deposito Campo local
     */
    Route::get('depositos-al-campo-local', ['uses' => 'LocalFieldIncomeController@create', 'as' => 'deposit-local-field']);
    Route::get('lista-cuenta-campo-local', ['uses' => 'LocalField\BankLocalFieldController@listBankLocalField', 'as' => 'cuenta-local-field']);
    Route::post('save-deposit-local-field', 'LocalFieldIncomeController@store');
    Route::post('upload-local-field-deposit', 'LocalFieldIncomeController@upload');

    /**
     * Depositos de Iglesia
     */
    Route::get('depositos-de-la-iglesia', ['uses' => 'Bank\ChurchDepositController@create', 'as' => 'register-deposit']);
    Route::get('lista-depositos', ['uses' => 'Bank\ChurchDepositController@lists', 'as' => 'list-deposit']);
    Route::post('save-church-deposit', 'Bank\ChurchDepositController@store');
    Route::post('upload-church-deposit', 'Bank\ChurchDepositController@upload');
    Route::post('remove-deposit', 'Bank\ChurchDepositController@remove');

    /**
     * Cuentas de Ingresos
     */
    Route::get('registrar-ingresos', ['uses' => 'IncomeAccountController@create', 'as' => 'create-incomes']);
    Route::post('save-incomes', 'IncomeAccountController@store');
    /**
     * listas Cuentas de Ingresos
     */
    Route::get('lista-de-cuentas-de-ingresos', ['uses' => 'IncomeAccountController@index', 'as' => 'lista-de-cuentas-de-ingresos']);
    Route::get('lists-income-account', 'IncomeAccountController@getData');
    //controles internos
    Route::get('registro-control-interno', ['uses' => 'InternalControlController@create', 'as' => 'create-internal-control']);
    Route::get('lista-control-interno', ['uses' => 'InternalControlController@index', 'as' => 'lista-internal-control']);
    Route::get('image-control-interno/{month}/{name}', ['uses' => 'InternalControlController@index', 'as' => 'image-internal-control']);

    Route::post('save-internal-control', 'InternalControlController@store');
    Route::post('upload-internal-control', 'InternalControlController@upload');
    Route::post('delete-internal-control', 'InternalControlController@destroy');
    Route::post('balance-internal-control', 'InternalControlController@balanceInfo');
    Route::post('balance-internal-control-check', 'InternalControlController@balanceInfoCheck');
    Route::post('save-register-incomes', 'InternalControlController@store');
    // Listas para controles internos
    Route::get('list-control-interno', ['uses' => 'InternalControlController@getData', 'as' => 'list-internal-control']);
    Route::get('lista-informes-reportados', ['uses' => 'InternalControlController@InfosReport', 'as' => 'list-reportados']);
    Route::get('lista-informes-sin-reportados', ['uses' => 'InternalControlController@InfosSinReport', 'as' => 'list-sin-reportados']);
    Route::get('lista-info-sin-deposito', ['uses' => 'InternalControlController@listInfos', 'as' => 'list-infos-sin-deposito']);
    Route::get('lista-de-clubes-de-iglesias', ['uses' => 'ReportsPDF\ReportsClubesController@listChruchClub', 'as' => 'list-clubes-iglesia']);

    /**
     * Informes semanales
     */
    Route::get('lista-de-informes-semanales', ['uses' => 'WeeklyIncomeController@index', 'as' => 'lista-de-informes-semanales']);
    Route::get('list-de-informes-semanales', 'WeeklyIncomeController@getData');
    Route::get('registro-de-ingresos/{token}', ['uses' => 'WeeklyIncomeController@create', 'as' => 'registro-de-ingresos']);
    Route::post('save-weekly-incomes', 'WeeklyIncomeController@store');
    Route::post('finish-info-income', 'WeeklyIncomeController@finish');
    Route::get('check-finish-info/{token}', 'WeeklyIncomeController@checkFinishInfo');
    Route::get('list-member-weekly/{date}', 'MemberController@listMemberInfo');
    //temporales
    Route::post('save-campo-temp-income', 'TempLocalFieldIncomeController@store');
    Route::post('remove-campo-temp-income', 'TempLocalFieldIncomeController@remove');
    Route::post('save-iglesia-temp-income', 'TempIncomesController@store');
    Route::post('remove-iglesia-temp-income', 'TempIncomesController@remove');
    Route::post('remove-line-income', 'WeeklyIncomeController@removeLine');

    /**
     * Gastos
     */
    Route::get('crear-account-gastos', ['uses' => 'Church\CheckAndExpenses\ExpenseAccountController@create', 'as' => 'create-expenses']);
    Route::get('lista-de-cuentas-de-gastos', ['uses' => 'Church\CheckAndExpenses\ExpenseAccountController@index', 'as' => 'lista-cuentas-expenses']);
    Route::get('list-account-gastos', ['uses' => 'Church\CheckAndExpenses\ExpenseAccountController@getData', 'as' => 'list-expenses']);
    Route::get('move-account-gastos/{token}', ['uses' => 'Church\CheckAndExpenses\ExpenseAccountController@moveExpense', 'as' => 'move-expenses']);
    Route::post('save-expense', 'Church\CheckAndExpenses\ExpenseAccountController@store');

    Route::get('registro-de-gastos', ['uses' => 'Church\CheckAndExpenses\CheckExpenseAccountController@create', 'as' => 'register-expenses']);
    Route::get('registro-detalle-cheque/{token}', 'Church\CheckAndExpenses\CheckExpenseAccountController@createCheck');
    Route::get('lista-de-gastos-not/{check}', 'Church\CheckAndExpenses\CheckExpenseAccountController@balanceNot');
    Route::get('balance-de-gastos-not', 'Church\CheckAndExpenses\CheckExpenseAccountController@balanceNotC');
    Route::get('lista-de-gastos', 'Church\CheckAndExpenses\CheckExpenseAccountController@listsAplicado');
    Route::get('lists-check-expenses', 'Church\CheckAndExpenses\CheckExpenseAccountController@getData');
    Route::get('lista-de-todos-los-gastos', ['uses' => 'Church\CheckAndExpenses\CheckExpenseAccountController@index', 'as' => 'list-expenses']);
    Route::post('save-expense-invoice', 'Church\CheckAndExpenses\CheckExpenseAccountController@store');
    Route::post('finish-expense-invoice', 'Church\CheckAndExpenses\CheckExpenseAccountController@finish');
    Route::get('edit-expense-invoice/{token}', 'Church\CheckAndExpenses\CheckExpenseAccountController@edit');
    Route::post('remove', 'Church\CheckAndExpenses\CheckExpenseAccountController@destroy');
    /**
     * Cheques
     */
    Route::get('registro-de-cheques', ['uses' => 'Church\CheckAndExpenses\CheckController@create', 'as' => 'create-check']);
    Route::get('lista-de-cheques', ['uses' => 'Church\CheckAndExpenses\CheckController@listCheck', 'as' => 'list-check']);
    Route::get('lista-de-cheques-local-field', ['uses' => 'Church\CheckAndExpenses\CheckController@listCheckLF', 'as' => 'list-check-LF']);
    Route::post('save-check', 'Church\CheckAndExpenses\CheckController@store');
    Route::post('upload-check', 'Church\CheckAndExpenses\CheckController@upload');
    Route::post('delete-check', 'Church\CheckAndExpenses\CheckController@destroy');
    /**
     * Transferencias entre cuentas
     */
    Route::get('transferencias-de-cuentas', ['uses' => 'Church\ChurchController@transfers', 'as' => 'transfer-of-accounts']);
    Route::post('save-transferencias', 'Church\ChurchController@transfersStore');

    Route::get('registro-miembros-cobros', ['uses' => 'MemberController@registerMemMatEscSab', 'as' => 'regMemMatEscSab']);


    Route::get('lista-miembros1', ['uses' => 'MemberController@index', 'as' => 'list-departament']);
    Route::get('lista-miembros11', ['uses' => 'MemberController@index', 'as' => 'change-status']);
    Route::get('lista-miembro3s', ['uses' => 'MemberController@index', 'as' => 'create-cta-ing']);
    Route::get('lista-miembro4s', ['uses' => 'MemberController@index', 'as' => 'list-cta-gto']);
    Route::get('actualizar-clave-de-usuario', 'UserController@updateClaveUser')->name('editar-clave-user');
    //Reportes
    Route::get('reporte-semanal/{token}', ['uses' => 'ReportPdfController@infoSemanal', 'as' => 'reportWeekly']);
    Route::get('reporte-semanal-email/{token}', ['uses' => 'ReportPdfController@infoSemanalEmail', 'as' => 'reportWeeklyEmail']);
    Route::get('pdf-de-gastos/{token}', 'ReportPdfController@checkDetail');
    Route::get('reporte-resumen-movimiento-departamento/{token}', 'ReportsPDF\ReportsDepartamentsController@pdfSummaryMoveDepartament');
    Route::get('reporte-estado-de-cuenta-actual/{token}', 'ReportPdfController@stateAccountNow');
    /**
     * Secretaria
     */
    Route::post('store-usuarios', 'UserController@store');
    Route::post('update-usuarios', 'UserController@update');
    Route::get('crear/usuarios', 'UserController@create')->name('createUser');
    Route::get('lista-user-select', 'UserController@labelSelect');
    Route::get('lista-churchs-select', 'Church\ChurchController@listsSelect');
    Route::get('lista-churchs-select-campos', 'Church\ChurchController@listsSelectCampo');
    Route::get('lista-unions-select', 'UnionController@labelSelect');
    Route::get('lista-local-select', 'LocalField\LocalFieldController@listsSelect');
    Route::get('nuevo-cargo-usuario', 'LocalField\WhereUserBelongController@create')->name('nuevoCargoUsuario');
    Route::post('nuevo-cargo-usuario', 'LocalField\WhereUserBelongController@store');
});
