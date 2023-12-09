<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'plugin/certificate', 'middleware' => ['auth', 'locale'] ], function() {
    Route::get('{course_id}/download', 'CertificateController@generateCertificate')->name('download_certificate');
});


Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'admin', 'locale'] ], function() {

    Route::group(['prefix'=>'settings'], function() {
        Route::get('certificate', 'CertificateController@certificateSettings')->name('certificate_settings');
    });
});
