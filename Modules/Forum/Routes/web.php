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

Route::prefix('forum')->group(function () {
    Route::get('/', 'ForumController@index')->name('forum.index');
});

Route::post('community-forums/status', 'ForumController@changeStatus')->name('forum.changeStatus');

Route::post('community-forums/add', 'ForumTopicController@addforums')->name('add.forumsList');
Route::post('community-forums-category/add', 'ForumTopicController@addforumscategory')->name('add.forumsCategory');
Route::get('community-forums', 'ForumTopicController@forumsList')->name('forumsList');

Route::get('community-forums/{slug}', 'ForumTopicController@forumsDetails')->name('forumsDetails');
Route::get('community-forums/save/{id}', 'ForumTopicController@commentSave')->name('CommentSave');
Route::post('community-forums/delete/{id}', 'ForumTopicController@delete')->name('forum.delete');
Route::post('community-forums/edit/{id}', 'ForumTopicController@update')->name('forum.update');
Route::post('community-forums/reply', 'ForumTopicController@reply')->name('reply.forumsList');

Route::get('community-forums-fileter/{id}', 'ForumTopicController@forumsdetailsfilter')->name('forumsDetailsfilter');
