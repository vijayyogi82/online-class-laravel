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

            Route::prefix('ebook')->group(function() {
                Route::get('/', 'EbookController@index')->name('ebook');
            });
            
            Route::get('ebook-categories', 'CategoryController@index')->name('ebook-category');
            Route::get('ebook-category/create', 'CategoryController@index')->name('ebook-category.create');
            Route::post('ebook-category/store', 'CategoryController@store')->name('ebook-category.store');
            Route::post('ebook-category/update', 'CategoryController@update')->name('ebook-category.update');
            Route::post('ebook-category/delete/{id}', 'CategoryController@destroy')->name('ebook-category.delete');
            
            Route::get('ebook/create', 'EbookController@create')->name('ebook.create');
            Route::post('ebook/store', 'EbookController@store')->name('ebook.store');
            Route::get('ebook/edit/{id}', 'EbookController@edit')->name('ebook.edit');
            Route::post('ebook/update/{id}', 'EbookController@update')->name('ebook.update');
            Route::post('ebook/delete/{id}', 'EbookController@destroy')->name('ebook.delete');

        });
    });
});
Route::get('ebook/reviews', 'EbookController@reviews')->name('ebook-reviews');
Route::post('ebook-review/delete/{id}', 'EbookController@reviewDelete')->name('ebook-review.delete');
Route::get('ebook/orders', 'EbookController@orders')->name('ebook-orders');
Route::post('ebook-order/delete/{id}', 'EbookController@orderDelete')->name('ebook-order.delete');

Route::get('web/ebook', 'WebController@index')->name('web.ebook');
Route::get('web/ebook/search', 'WebController@search')->name('web.ebook.search');
Route::get('web/ebook/detail/{id}', 'WebController@detail')->name('web.ebook.detail');
Route::get('filter/category/{id}', 'WebController@filter')->name('filter.category');
Route::post('ebook/rating', 'WebController@rating')->name('ebook.rating');
Route::post('ebook-dopayment', 'WebController@dopayment')->name('ebook-dopayment');
Route::get('web/ebook/confirm-order', 'WebController@orderConfirm')->name('web.ebook.confirm-order');
Route::get('my/ebook', 'WebController@myEbook')->name('web.ebook.confirm-order');
Route::get('my/ebook/invoice/{id}', 'WebController@myinvoice')->name('web.ebook.invoice');
Route::get('web/ebook/free/enroll/{id}', 'WebController@freeenroll')->name('web.ebook.free.enroll');

Route::get('web/ebook/addtocart/{id}', 'EbookCartController@addToCart')->name('web.ebook.addtocart');
Route::get('remove/cart/item/{id}', 'EbookCartController@removeItem')->name('remove.cart.item');
Route::get('web/ebook/cart', 'EbookCartController@cart')->name('web.ebook.cart');
Route::post('web/ebook/checkout', 'EbookCartController@checkout')->name('web.ebook.checkout');
Route::get('web/ebook/cart/checkout', 'EbookCartController@checkout_page')->name('web.ebook.cart.checkout');