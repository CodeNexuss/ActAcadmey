<?php

namespace App\Http\Controllers;

use App\AssignmentSubmission;
use App\Course;
use App\Content;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * Assignments for the instructors
     */
    public function index(){
        $title = __t('assignments');
        $user = Auth::user();
        $courses = $user->courses()->has('assignments')->get();

        return view(theme('dashboard.assignments.index'), compact('title', 'courses'));
    }

    /**
     * @param $course_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * View all assignments
     */
    public function assignmentsByCourse($course_id){
        $title = __t('assignments');
        $course = Course::find($course_id);
        $assignments = $course->assignments()->with('submissions')->paginate(50);

        return view(theme('dashboard.assignments.assignments'), compact('title', 'course', 'assignments'));
    }

    public function submissions($assignment_id){
        $title = __t('assignment_submissions');
        $assignment = Content::find($assignment_id);
        $submissions = $assignment->submissions()->paginate(50);

        return view(theme('dashboard.assignments.submissions'), compact('title', 'assignment', 'submissions'));
    }

    /**
     * @param $submission_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * All submission for the quiz
     */
    public function submission($submission_id){
        $title = __t('submission');
        $submission = AssignmentSubmission::find($submission_id);

        return view(theme('dashboard.assignments.submission'), compact('title', 'submission'));
    }

    /**
     * @param Request $request
     * @param $submission_id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     *
     * Evaluating the quiz
     */

    public function evaluation(Request $request, $submission_id){

        $submission = AssignmentSubmission::find($submission_id);
        $max_number = $submission->assignment->option('total_number');

        $rules = ['give_numbers' => "required|numeric|max:{$max_number}"];
        $this->validate($request, $rules);

        $user_id = Auth::user()->id;
        $time_now = Carbon::now()->toDateTimeString();

        $data = [
            'instructor_id' => $user_id,
            'earned_numbers' => $request->give_numbers,
            'instructors_note' => clean_html($request->evaluation_notes),
            'is_evaluated' => 1,
            'evaluated_at' => $time_now,
        ];

        $submission->update($data);
        return redirect()->back();
    }

}
