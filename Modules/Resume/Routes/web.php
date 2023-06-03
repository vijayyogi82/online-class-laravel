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

            Route::middleware(['is_admin'])->group(function () {

                Route::get('resume', 'ResumeController@adminindex')->name("resume.adminindex");
                Route::get('resume/approved/{id}', 'ResumeController@approved')->name("resume.approved");
                Route::post('resume/notapproved/{id}', 'ResumeController@notapproved')->name("resume.notapproved");
                Route::get('resume/view/{id}', 'ResumeController@view')->name("resume.view");
                Route::delete('resume/destroy/{id}', 'ResumeController@destroy')->name('resume.destroy');
                Route::post('/resume/resumestatus', 'ResumeController@resumestatus')->name('resume.resumestatus');
                Route::post('/resume/resumeverified', 'ResumeController@resumeverified')->name('resume.resumeverified');
                Route::get('adminjob', 'JobController@adminindex')->name('adminjob.index');
                Route::post('admin/jobstatus', 'JobController@adminstatus')->name('adminjob.status');
                Route::post('admin/jobapproved', 'JobController@adminapproved')->name('adminjob.approved');
                Route::post('admin/jobverified', 'JobController@adminverified')->name('adminjob.verified');
                Route::get('admin/jobview/{id}', 'JobController@adminjobview')->name('adminjob.view');
                Route::delete('admin/jobdestroy/{id}', 'JobController@adminjobdestroy')->name('adminjob.destroy');
              

            });

            Route::middleware(['is_verified', '2fa'])->group(function () {
                
                Route::get('resume/index/{id}', 'ResumeController@index')->name("resume.id");
                Route::get('resume/pdfdownload/{id}', 'ResumeController@pdfdownload')->name("resume.pdfdownload");
                Route::post('resume/store', 'ResumeController@store')->name("resume.store");
                Route::get('resume/edit/{id}', 'ResumeController@resumeedit')->name("resume.edit");
                Route::post('resume/update/{id}', 'ResumeController@resume_update')->name("resume.update");
                Route::get('myresume/view/{id}', 'ResumeController@myresumeview')->name("myresume.view");
                Route::post('job/applyjob/{id}', 'JobController@applyjob')->name('job.applyjob');
                Route::get('job', 'JobController@index')->name('job.index');
                Route::get('job/view/{id}', 'JobController@jobview')->name('job.view');
                Route::post('job/store/{id}', 'JobController@store')->name('job.store');
                Route::get('job/find', 'JobController@find')->name('job.find');
                Route::post('job/userstatus', 'JobController@userstatus')->name('job.userstatus');
                Route::delete('job/jobdestroy/{id}', 'JobController@jobdestroy')->name('job.jobdestroy');
                Route::delete('job/applyjobdestroy/{id}', 'JobController@applyjobdestroy')->name('job.applyjobdestroy');
                Route::get('filter', 'JobController@filter')->name('job.filter');
                Route::get('job/edit/{id}', 'JobController@jobedit')->name('job.edit');
                Route::post('job/update/{id}', 'JobController@jobupdate')->name('job.update');
                Route::get('job/show/{id}', 'JobController@jobshow')->name('job.show');
                Route::get('job/download/{id}', 'JobController@resume_download')->name('resume.download');
                Route::post('job/notapproved/{id}', 'JobController@jobnotapproved')->name('job.notapproved');
                Route::get('job/approved/{id}', 'JobController@jobapproved')->name('job.approved');
                Route::post('job/csvfileupload','JobController@csvfileupload')->name('job.csvfileupload');
                Route::get('job/import', 'JobController@import')->name('job.import');
                Route::get('job/search', 'JobController@search')->name('job.search');
                Route::get('job/setting','JobController@setting')->name('job.setting');
                Route::post('job/setting/update','JobController@update')->name('job.update');
    
            });

        });

    });

});
