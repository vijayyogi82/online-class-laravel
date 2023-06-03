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
use Modules\Onepay\Http\Controllers\OnepayController;

Route::prefix('onepay')->group(function() {
    Route::get('/', 'OnepayController@payment');
    Route::post('/dopayment', 'OnepayController@dopayment');
    Route::get('/callback', 'OnepayController@callback');
});

Route::group(['prefix' => '/admin' ,'middleware' => ['is_active', 'IsInstalled', 'switch_languages', 'is_admin', 'auth']], function() {
    Route::post('update/onepay/payment/settings', [OnepayController::class, 'updatesettings'])->name('onepay.payment.settings');
});