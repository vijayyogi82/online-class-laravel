<?php

use Illuminate\Support\Facades\Route;
use Modules\Bkash\Http\Controllers\BkashController;

Route::group(['middleware' => ['isActive', 'IsInstalled', 'switch_lang', 'auth']], function () {
    Route::get('/bkash_token', [BkashController::class, 'getToken']);
    Route::post('/bkash/checkout', [BkashController::class, 'createPayment']);
    Route::post('/bkash/execute', [BkashController::class, 'executePayment']);
    Route::get('/bkash/success', [BkashController::class, 'success']);
});
