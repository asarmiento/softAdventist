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
    return view('welcome');
});
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
Auth::routes();

Route::get('/confirmation/{token}', ['uses'=>'Auth\RegisterController@confirmation','as'=>'confirmation']);
Route::get('/activation/{email}', ['uses'=>'Auth\RegisterController@activation','as'=>'activation']);

Route::group(['prefix'=>'registrado','middleware'=>'auth'],function (){

    Route::get('inscription', ['uses'=>'HomeController@create','as'=>'create-inscription']);
    Route::post('inscription', ['uses'=>'HomeController@store','as'=>'save-inscription']);

});
