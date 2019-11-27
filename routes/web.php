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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');



Route::group(['prefix' => 'device'], function () {//区分
    Route::post('/add','HomeController@addDevice');
    Route::get('editdevice/{id}','EditDeviceController@index');
    Route::post('edit/{id}','EditDeviceController@editDevice');
    Route::delete('/{id}', 'HomeController@deleteDevice');
    Route::post('editdevice/{id}','EditDeviceController@sharebutton');

});
Route::group(['prefix' => 'button'], function () {//button
    Route::post('/add','HomeController@addButton');

    Route::get('edit/{id}','EditButtonController@index');
    Route::post('edit/{id}','EditButtonController@editButton');
    Route::delete('edit/{id}', 'EditButtonController@deleteButton');
    Route::get('/study/{id}','HomeController@study');

//    Route::get('/study/{id}','HomeController@study')->middleware('check.button');

});

Route::post('/button/{id}','IRController@updateIR');

Route::get('/study/start','apiController@startStudy');

Route::get('/unregister',function (){ return view('unregister');});

Route::post('/postunregister','Auth\SoftDeleteController@deleteData');

Route::get('contact', 'ContactController@index')->name('contact');
Route::get('/support', 'ContactController@index')->name('support');
Route::post('confirm', 'ContactController@confirm')->name('confirm');
//Route::post('confirm', function (){ return view('confirm');});
Route::post('/sent', 'ContactController@sent')->name('sent');

Route::get('/addDevice',function (){ return view('add_device');});

Route::post('/searchData','ShareController@searchData');
Route::post('/copyData','HomeController@copyDevice');


//Route::get('/send/{user_name}','apiController@getTemparature')->name('temprature');
//Route::get('/temp/{user_name}','apiController@updateTemparature');


//macro関連
Route::group(['prefix' => 'macro'], function () {//区分
    Route::get('/','AddMacroController@index');
    Route::get('/edit/{id}','EditMacroController@index');
    Route::post('/add','AddMacroController@addMacro');
    Route::post('/update/{id}','EditMacroController@updateMacro');
    Route::delete('/delete/{id}','EditMacroController@deleteMacro');
    Route::post('/run','apiController@runMacro');
    Route::get('/getData/{id}','EditMacroController@getData');
});




// 全ユーザ
//Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
Route::get('/send/{user_name}','apiController@getCode');
Route::get('/temp/{user_name}','apiController@getTemparature')->name('temprature');
Route::get('/updatetemp/{user_name}','apiController@updateTemparature');
//});

