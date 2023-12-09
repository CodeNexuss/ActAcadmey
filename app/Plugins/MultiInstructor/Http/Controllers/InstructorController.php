<?php

namespace App\Plugins\MultiInstructor\Http\Controllers;


use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstructorController extends Controller{

    /**
     * @param $course_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function instructors($course_id){
        $title = __t('instructors');
        $course = Course::find($course_id);
        if ( ! $course || ! $course->i_am_instructor){
            abort(404);
        }

        return view(theme('dashboard.courses.instructors'), compact('title', 'course'));
    }

    /**
     * @param Request $request
     * @param $course_id
     * @return array
     *
     * Search available instructor from the database.
     */
    public function searchInstructor(Request $request, $course_id){
        $q = $request->q;
        $addedIds = DB::table('course_user')->where('course_id', $course_id)->pluck('user_id');

        $instructors = User::active()->instructor()->whereNotIn('id', $addedIds)->where(function($query)use($q){
            $query->where('name', 'LIKE', "%{$q}%")->orWhere('email', 'LIKE', "%{$q}%");
        })->get();

        $html = view_template_part('dashboard.courses.instructor_search', compact('instructors', 'course_id'));

        return ['success' => 1, 'html' => $html];
    }

    /**
     * @param Request $request
     * @param $course_id
     * @return \Illuminate\Http\RedirectResponse
     *
     * Add multiple instructor to this course
     */
    public function addInstructors(Request $request, $course_id){
        $instructor_ids = $request->instructors;

        if (is_array($instructor_ids) && count($instructor_ids)){
            $course = Course::find($course_id);
            $now = Carbon::now()->toDateTimeString();

            foreach ($instructor_ids as $instructor_id){
                if ( ! $course->instructors->contains($instructor_id)){
                    $course->instructors()->attach($instructor_id, ['added_at' => $now]);
                }
            }
        }
        return back()->with('success', __t('instructors_added'));
    }

    /**
     * @param Request $request
     * @param $course_id
     * @return \Illuminate\Http\RedirectResponse
     *
     * Remove Specific instructor from this course
     */
    public function removeInstructors(Request $request, $course_id){
        $course = Course::find($course_id);
        $course->instructors()->detach($request->instructor_id);
        return back()->with('success', __t('instructor_removed'));
    }


}
