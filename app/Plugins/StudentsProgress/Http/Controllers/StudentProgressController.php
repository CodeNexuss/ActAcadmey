<?php

namespace App\Plugins\StudentsProgress\Http\Controllers;


use App\Course;
use App\Http\Controllers\Controller;
use App\User;

class StudentProgressController extends Controller
{

    public function index($course_id = null){
        $title = __t('students_progress_report');

        if ($course_id){
            return view(theme('dashboard.plugins.student-progress.index'), compact('title', 'course_id'));
        }


        return view(theme('dashboard.plugins.student-progress.courses'), compact('title', 'course_id'));
    }

    public function details($course_id, $user_id){
        $title = __t('students_progress_report');
        $course = Course::find($course_id);
        $user = User::find($user_id);

        return view(theme('dashboard.plugins.student-progress.details'), compact('title', 'course', 'user'));
    }

}
