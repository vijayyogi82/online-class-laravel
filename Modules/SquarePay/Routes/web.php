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
use Modules\SquarePay\Http\Controllers\SquarePayController;

Route::prefix('squarepay')->group(function() {
    Route::post('/create/payment/', [SquarePayController::class,'payment'])->name('squarepay.create.payment');
    Route::post('/payment', [SquarePayController::class,'storepayment'])->name('squarepay.front.payment');
});

Route::group(['middleware' => ['isActive', 'IsInstalled', 'switch_lang', 'admin_access', 'auth']], function () {

    Route::post('admin/squarepay/payment/settings', [SquarePayController::class, 'saveKeys'])->name('squarepay.payment.setting');

});

