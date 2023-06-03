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
use Modules\Midtrains\Http\Controllers\MidtrainsController;

Route::prefix('midtrains')->group(function() {
    Route::post('/token', [MidtrainsController::class,'token'])->name('midtrains.get.token');
    Route::post('/payment', [MidtrainsController::class,'payment'])->name('midtrains.front.payment');
});
