<?php

Route::group(['middleware' => ['web'],'prefix' => 'user', 'namespace' => 'App\Modules\Users\Controllers'], function () {

	
	Route::get('/','UserController@index');
	
	Route::post('save','UserController@saveData');

	Route::get('getUsers','UserController@getUsersData');


});