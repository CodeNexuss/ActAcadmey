<?php

use Illuminate\Support\Facades\Route;



Route::group(['prefix'=>'dashboard', 'middleware' => ['auth', 'locale'] ], function() {
    /**
     * Only instructor has access in this group
     */
    Route::group(['middleware' => ['instructor', 'locale'] ], function() {
        Route::group(['prefix' => 'courses' ], function() {
            Route::group(['prefix' => '{course_id}/instructors' ], function() {

                Route::get('/', 'InstructorController@instructors')->name('edit_course_instructors');
                Route::post('search', 'InstructorController@searchInstructor')->name('multi_instructor_search');
                Route::post('add', 'InstructorController@addInstructors')->name('add_instructors');
                Route::post('remove', 'InstructorController@removeInstructors')->name('remove_instructor');

            });
        });
    });

});
