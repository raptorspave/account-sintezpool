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

Route::get('/farm/{id}', 'FarmController@show')
	->middleware('check', 'status')
	->where('id', '[0-9]+')
	->name('site.farm');

Route::middleware(['check', 'status'])
	->prefix('transaction')
	->group(function () {
	Route::post('{id}/edit', 'FarmController@edit')
		->where('id', '[0-9]+')
		->name('site.transaction.edit');

	Route::post('{id}/delete', 'FarmController@delete')
		->where('id', '[0-9]+')
		->name('site.transaction.delete');

	Route::post('{farm_id}/add', 'FarmController@add')
		->where('farm_id', '[0-9]+')
		->name('site.transaction.add');
});

/**
 *	Test
 */

Route::get('/test', 'IndexController@index');

/**
 *	Voyager
 */

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


