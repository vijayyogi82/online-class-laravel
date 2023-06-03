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

Route::prefix('esewa')->group(function() {
    Route::get('/', 'EsewaController@index');
});



Route::any('esewa/success', 'EsewaController@success')->name('esewa.success');
Route::any('esewa/fail', 'EsewaController@fail')->name('esewa.fail');
Route::get('payment/response', 'EsewaController@payment_response')->name('payment.response');
