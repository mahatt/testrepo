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




// RESOURCE FU ROUTES

Route::group(['prefix'=>'btype'],function(){

Route::get('merchant','MerchantController@index');
Route::get('merchant/{phoneNumber}','MerchantController@getByPhoneNumber');

});



//DB::listen (function ($query) {var_dump($query->sql); })