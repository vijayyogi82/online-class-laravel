<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
 */

use Illuminate\Support\Facades\Route;
use Modules\DPOPayment\Http\Controllers\DPOPaymentController;

Route::group(['middleware' => ['is_active', 'IsInstalled', 'switch_languages', 'auth','is_verified','maintanance_mode','2fa']], function () {
    Route::post('/dpo/payment/proccess', [DPOPaymentController::class, 'createToken'])->name('dpo.payment.process');
    Route::get('/dpo/paymentsuccess', [DPOPaymentController::class, 'success']);
});

