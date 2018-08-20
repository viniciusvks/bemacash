<?php

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::any('/smoke-signal', 'SmokeSignalController@send')
    ->name('signal.send');

Route::group(['prefix' => 'order'], function (){

    Route::get('', 'OrderController@index')
        ->name('order.list');

    Route::get('{id}', 'OrderController@show')
        ->name('order.show');

});
