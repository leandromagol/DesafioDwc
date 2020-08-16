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
//Route::resource('pedidosbrinde', 'Api\PedidosBrindeController');

Route::resource('cliente', 'Api\ClienteController');
Route::group(['middleware' => 'cors'], function () {
    Route::get('pedidosbrinde', 'Api\PedidosBrindeController@index');
    Route::get('pedidosbrinde/{id}', 'Api\PedidosBrindeController@show');
    Route::post('pedidosbrinde', 'Api\PedidosBrindeController@store');
    Route::put('pedidosbrinde/{id}', 'Api\PedidosBrindeController@update');
    Route::delete('pedidosbrinde/{id}','Api\PedidosBrindeController@destroy');
});