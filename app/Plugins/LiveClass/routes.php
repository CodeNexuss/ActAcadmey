<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'admin', 'locale'] ], function() {

    Route::group(['prefix'=>'settings'], function() {
        Route::get('live-class', 'LiveClassController@settings')->name('live_class_settings');
    });
});



Route::group(['prefix'=>'dashboard', 'middleware' => ['auth', 'locale'] ], function() {
    /**
     * Only instructor has access in this group
     */
    Route::group(['middleware' => ['instructor'] ], function() {
        Route::group(['prefix' => 'courses' ], function() {
            Route::group(['prefix' => '{course_id}/live_class' ], function() {

                Route::get('/', 'LiveClassController@lessonLiveSettings')->name('edit_course_live_class');
                Route::post('/', 'LiveClassController@lessonLiveSettingsPost');

            });
        });
    });

});


Route::get('courses/{slug}/live-class', 'LiveClassController@liveClassStream')->name('live_class_stream');
