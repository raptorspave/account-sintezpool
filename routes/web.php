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

Route::get('/login', 'AuthController@login')->name('site.auth.login');
Route::post('/login', 'AuthController@loginPost')->name('site.auth.loginPost');

Route::get('/register', 'AuthController@register')->name('site.auth.register');
Route::post('/register', 'AuthController@registerPost')->name('site.auth.registerPost');

Route::get('/logout', 'AuthController@logout')->name('site.auth.logout');

/**
 *	Account
 */

Route::get('/', 'FarmController@index')
	->middleware('check', 'status')
	->name('site.home');

Route::get('/farm/{farmID}', 'FarmController@show')
	->middleware('check', 'status')
	->where('farmID', '[0-9]+')
	->name('site.farm');

/**
 *	Test
 */

Route::get('/test', function () {
	//
});

/**
 *	Voyager
 */

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


