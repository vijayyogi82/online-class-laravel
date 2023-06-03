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
use Illuminate\Support\Facades\Route;
use Modules\Onepay\Http\Controllers\UpiController;

    Route::get('/upi', 'UpiController@index')->name('upi');
    Route::post('upi/update','UpiController@update')->name('upi.update');
