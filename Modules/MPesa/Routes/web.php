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
use Modules\MPesa\Http\Controllers\MPesaController;

Route::group(['middleware' => ['is_active', 'IsInstalled', 'switch_languages', 'auth']], function () {
    Route::post('payvia/mpesa',[MPesaController::class,'pay'])->name('payvia.mpesa');
    Route::post('mpesa/verifypay/{checkoutid}',[MPesaController::class,'verifypay'])->name('verify.mpesa');
});

Route::group(['middleware' => ['is_active', 'IsInstalled', 'switch_languages', 'is_admin', 'auth']], function () {

    Route::post('update/mpesa/payment/settings', [MPesaController::class, 'updatesettings'])->name('mpesa.payment.settings');

    Route::get('admin/mpesa/settings',[MPesaController::class, 'adminsettings'])->name('mpesa.setting');

});




