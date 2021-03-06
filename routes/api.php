<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 *
 */

Route::get('/transaction/{farm_id}/{currency_id}', 'Api\FarmController@transaction')
	->middleware('check', 'status')
	->where(['farm_id' => '[0-9]+', 'currency_id' => '[0-9]+']);