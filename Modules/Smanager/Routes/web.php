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

Route::prefix('smanager')->group(function() {
    Route::get('/', 'SmanagerController@index');
});


Route::post('/smanager/index', 'SmanagerController@index')->name('smanager.index');

// sManager
Route::get('/smanager/success', 'SmanagerController@success')->name('smanager.success');
Route::get('/smanager/fail', 'SmanagerController@fail')->name('smanager.fail');
