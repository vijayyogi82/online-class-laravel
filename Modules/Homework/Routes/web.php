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

Route::middleware(['web'])->group(function () {

    Route::middleware(['IsInstalled', 'switch_languages', 'ip_block'])->group(function () {

        Route::middleware(['is_active', 'auth', 'maintanance_mode'])->group(function () {

            Route::middleware(['admin_instructor'])->group(function () {

                Route::get('homework/{id}', 'HomeworkController@index')->name('homework.index');
                Route::get('/homework_create/{id}', 'HomeworkController@create')->name('homework.create');
                Route::post('/homework_store', 'HomeworkController@store')->name('homework.store');
                Route::get('/homework_edit/{id}/{cat}', 'HomeworkController@edit')->name('homework.edit');
                Route::post('/homework_update/{id}/{cat}', 'HomeworkController@update')->name('homework.update');
                Route::delete('/homework_delete/{id}', 'HomeworkController@delete')->name('homework.delete');
                
                Route::get('/homework/view/{id}/{cat}', 'HomeworkController@view')->name('homework.view');
                Route::post('/homework/marks_update/{id}/', 'HomeworkController@marksupdate')->name('marks.update');

                Route::post('/homework/status', 'HomeworkController@status')->name('homework.status');
                Route::post('/homework/compulsory', 'HomeworkController@compulsory')->name('homework.compulsory');

            });

            Route::middleware(['is_verified', '2fa'])->group(function () {

                Route::get('/homework/download/{id}/', 'HomeworkController@download')->name('homework.download');
                Route::post('course/homework/{id}', 'HomeworkController@submit')->name('homework.submit');
                Route::get('/submithomework/download/{id}/', 'HomeworkController@submithomeworkdownload')->name('submithomework.download');

            });

        });

    });

});