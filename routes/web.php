<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/web/messages','MerchantMessagesViewController@listAll');
Route::get('/web/merchants','MerchantViewController@listAll');
Route::get('/web/customers','CustomerViewController@listAll');
Route::get('/web/transactions','TransactionViewController@listAll');


// RESOURCE FU ROUTES




//DB::listen (function ($query) {var_dump($query->sql); })