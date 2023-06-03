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
use Modules\Paytab\Http\Controllers\PaytabController;

Route::prefix('paytabs')->group(function() {
    Route::post('/payment', [PaytabController::class,'payment'])->name('paytabs.front.payment');
    Route::post('/callback',[PaytabController::class,'callback'])->name('paytabs.callback');
});

