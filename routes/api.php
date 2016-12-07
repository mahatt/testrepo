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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');



Route::group(['prefix'=>'btype'],function(){

//Route::get('merchant','MerchantController@index');

Route::get('merchant/{phoneNumber}','MerchantController@getByPhoneNumber');
Route::post('merchant','MerchantController@store');
Route::delete('merchant','MerchantController@remove');

Route::post('merchant/addpoints','MerchantController@addpoints');
Route::post('merchant/subpoints','MerchantController@subpoints');

Route::post('offer/new','MerchantOfferController@store');

Route::get('offer','MerchantOfferController@getByPhoneNumber');
Route::delete('offer','MerchantOfferController@remove');

Route::get('customer','CustomerController@getByPhoneNumber');
Route::post('customer','CustomerController@store');


Route::post('loyalty', 'LoyaltyTransactionController@transfer');
Route::post('claim' , 'LoyaltyTransactionController@claim')


});
