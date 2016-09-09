<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::group(array('prefix' => 'api'), function() {

    Route::get('/getVehicleLists', 'SpaController@getVehicleLists');
    Route::get('/nextDate/{lastDate}', 'SpaController@nextDate');
    Route::post('/saveData', 'SpaController@saveData');
    Route::post('/saveDataMass', 'SpaController@saveDataMass');
    
    Route::resource('spa', 'SpaController', 
        array('only' => array('index', 'nextDate', 'store', 'destroy')));
  
});

