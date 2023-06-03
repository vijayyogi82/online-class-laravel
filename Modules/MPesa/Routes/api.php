<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\MPesa\Http\Controllers\MPesaController;

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

Route::post('/m/confirm',[MPesaController::class,'confirm']);
Route::post('/m/validate',[MPesaController::class,'validation']);
