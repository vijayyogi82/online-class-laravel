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

Route::prefix('certificate')->group(function() {
    Route::get('/', 'CertificateController@index');
});


// ===== certificate start =============
Route::get('certificate', 'CertificateDesignController@studcertificate')->name('course.certificate');

Route::get('create', 'CertificateDesignController@createcertificate')->name('create.certificate');


Route::post('add-logo', 'CertificateDesignController@insertlogo')->name('insertlogo.certificate');
Route::post('add-content', 'CertificateDesignController@insertcontent')->name('insertcontent.certificate');
Route::post('add-certificate-background', 'CertificateDesignController@insertcertificatebackground')->name('insertcertificatebackground.certificate');
Route::post('add-outer-border', 'CertificateDesignController@insertouterborder')->name('insertouterborder.certificate');
Route::post('add-inner-border', 'CertificateDesignController@insertinnerborder')->name('insertinnerborder.certificate');
Route::post('add-signature', 'CertificateDesignController@insertsignature')->name('insertsignature.certificate');
Route::post('add-date', 'CertificateDesignController@insertdate')->name('insertdate.certificate');
Route::post('widget/setting', 'CertificateDesignController@widget')->name('widgetsetting.certificate');


// ===== certificate end ===============
Route::get('manage/certificate', 'CertificateDesignController@setting')->name('certificate.setting');
Route::post('manage/certificate', 'CertificateDesignController@updatesetting')->name('manage.certificate');
Route::get('design.certificate/download/{slug}', 'CertificateDesignController@pdfdownload')->name('certificate.design.download');
