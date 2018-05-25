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

/**
 *	Test
 */

// Route::get('/test', 'IndexController@index');

/**
 *	Auth
 */

Route::get('/login', 'AuthController@login')->name('site.auth.login');
Route::post('/login', 'AuthController@loginPost')->name('site.auth.loginPost');

Route::get('/register', 'AuthController@register')->name('site.auth.register');
Route::post('/register', 'AuthController@registerPost')->name('site.auth.registerPost');

Route::get('/logout', 'AuthController@logout')->name('site.auth.logout');

/**
 *	Forgot Password
 */

Route::prefix('password')->group(function ()
{
	Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
		->name('password.request');

	Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')
		->name('password.reset');

	Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
		->name('password.email');

	Route::post('reset', 'Auth\ResetPasswordController@reset');
});

/**
 *	Account
 */

Route::get('/', 'FarmController@index')
	->middleware('check', 'status:home')
	->name('site.home');

Route::get('/farm/{farm_id}', 'FarmController@show')
	->middleware('check', 'status')
	->where('farm_id', '[0-9]+')
	->name('site.farm');

Route::prefix('transaction')->group(function ()
{
	Route::post('{transaction_id}/edit', 'FarmController@edit')
		->middleware('check', 'status')
		->where('transaction_id', '[0-9]+')
		->name('site.transaction.edit');

	Route::post('{transaction_id}/delete', 'FarmController@delete')
		->middleware('check', 'status')
		->where('transaction_id', '[0-9]+')
		->name('site.transaction.delete');

	Route::post('{farm_id}/add', 'FarmController@add')
		->middleware('check', 'status')
		->where('farm_id', '[0-9]+')
		->name('site.transaction.add');
});

/**
 *	Voyager
 */

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


