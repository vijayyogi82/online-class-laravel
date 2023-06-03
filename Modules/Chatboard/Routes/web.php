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
Route::middleware(['auth'])->group(function () {
    Route::prefix('chatboard')->group(function() {
            Route::get('/', 'ChatController@chatlist');
            Route::get('/chat/{userid}','ChatController@createchat')->name('chat.start');
            Route::get('/chat/view/{conversation}','ChatController@chatscreen')->name('chat.screen');
            Route::post('/send/message/chat/{conversion_id}','ChatController@sendmessage')->name('send.message');
            Route::post('/get/live/chat/{conversion_id}','ChatController@get_chat')->name('get.live.chat');
    });
});
