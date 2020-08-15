<?php

use App\Jobs\EmailConfirmacaoCompra;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/envio_email',function(){
    //return new \App\Mail\EmailConfirmacaoCompra();
    EmailConfirmacaoCompra::dispatch('wandalorrannyy@gmail.com
')->delay(now());
    return true;
});
