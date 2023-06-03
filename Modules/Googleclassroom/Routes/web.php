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

Route::prefix('googleclassroom')->group(function() {
    Route::get('dashboard','GoogleClassRoomController@dashboard')->name('googleclassroom.index');
    Route::get('setting','GoogleClassRoomController@classroomsetting')->name('googleclassroom.setting');
    Route::post('googlement-token/update','GoogleClassRoomController@classroomupdatefile')->name('googleclassroom.updatefile');
    Route::get('allclass', 'GoogleClassRoomController@allclass')->name('googleclassroom.allclass');
    Route::get('oauths', ['as' => 'oauthCallback', 'uses' => 'GoogleClassRoomController@oauths']);
    Route::get('create/class','GoogleClassRoomController@create')->name('googleclassroom.cource.create');
    Route::post('store/new/class','GoogleClassRoomController@store')->name('googleclassroom.store');
    Route::post('class-bulk-delete', 'GoogleClassRoomController@bulk_delete')->name('googlecource.bulk.delete');
    Route::get('edit/class/{courceid}','GoogleClassRoomController@edit')->name('googleclassroom.edit');
    Route::post('update/class/{courceid}','GoogleClassRoomController@update')->name('googleclassroom.update');
    Route::delete('delete/class/{id}','GoogleClassRoomController@destroy')->name('googleclassroom.delete');
    Route::get('class-status','GoogleClassRoomController@status')->name('googleclassroom.status');
    Route::get('detail/{id}', 'GoogleClassRoomController@detail')->name('googleclassroom.detail');
});


