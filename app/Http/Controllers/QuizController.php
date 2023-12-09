<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Attempt;
use App\Content;
use App\Course;
use App\Question;
use App\QuestionOption;
use App\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{

    public function quizView($slug, $quiz_id){
        $quiz = Content::find($quiz_id);
        $course = $quiz->course;
        $title = $quiz->title;

        $isEnrolled = false;
        $isEnrolledQuiz = false;
        if (Auth::check()){
            $user = Auth::user();

            // if($user->isAdmin()) {
            //     $isEnrolled = true;
            //     $isEnrolledQuiz = false;
            // } else {
            //     $isEnrolled = ($quiz->drip->is_lock) ? false : $user->isEnrolled($course->id);
            //     $isEnrolledQuiz = $user->isEnrolled($course->id);
            // }
            
            $isEnrolled = ($quiz->drip->is_lock) ? false : $user->isEnrolled($course->id);
            $isEnrolledQuiz = $user->isEnrolled($course->id);
        }

        return view(theme('quiz'), compact('course', 'title', 'isEnrolled', 'quiz', 'isEnrolledQuiz'));
    }

    public function start(Request $request){
        $user = Auth::user();

        $quiz_id = $request->quiz_id;
        $previous_attempt = $user->get_attempt($quiz_id);

        if ( ! $previous_attempt) {
            $quiz = Quiz::find($quiz_id);
            $passing_percent = (int) $quiz->option('passing_score');

            $data = [
                'course_id' => $quiz->course_id,
                'quiz_id' => $quiz_id,
                'user_id' => $user->id,
                'questions_limit' => $quiz->option('questions_limit'),
                'status' => 'started',
                'quiz_gradable' => $quiz->quiz_gradable,
                'passing_percent' =>  $passing_percent,
            ];

            Attempt::create($data);
            session()->forget('current_question');
        }
        return ['success' => 1, 'quiz_url' => route('quiz_attempt_url', $quiz_id)];
    }

    public function quizAttempting($quiz_id){
        $quiz = Quiz::find($quiz_id);
        if ( ! $quiz){
            abort(404);
        }

        $user = Auth::user();
        $attempt = $user->get_attempt($quiz_id);
        if ( ! $attempt || $attempt->status !== 'started') {
            abort(404);
        }

        $isEnrolled = $user->isEnrolled($quiz->course_id);
        if ( ! $isEnrolled){
            abort(404);
        }

        /**
         * Finished The attempt if answered equal to question limit
         */
        $answered = Answer::whereQuizId($quiz_id)->whereUserId($user->id)->get();
        $question_count = $quiz->questions()->count();
        $question_limits = $question_count > $attempt->questions_limit ? $attempt->questions_limi :  $question_count;

        if ($answered->count() >= $question_limits){
            //Finished Quiz

            $reviewRequired = Answer::query()->where(function($q){
                $q->where('q_type', 'text')->orWhere('q_type', 'textarea');
            })->count();

            $q_score = $attempt->answers->sum('q_score');
            $attempt->total_answered = $attempt->answers->count();
            $attempt->total_scores = $q_score;

            if ($reviewRequired){
                $attempt->status = 'in_review';
            }else{
                $attempt->status = 'finished';
            }
            $attempt->ended_at = Carbon::now()->toDateTimeString();
            $attempt->save_and_sync();

            return redirect($quiz->url);
        }
        $q_number = $answered->count() +1;
        $title = $quiz->title;

        $answered_q_ids = $answered->pluck('question_id')->toArray();

        $current_q_id = session('current_question');
        if ($current_q_id){
            $question = Question::find($current_q_id);
        }else{
            $question = $quiz->questions()->whereNotIn('id', $answered_q_ids)->inRandomOrder()->first();
        }

        session(['current_question' => $question->id]);

        return view(theme('quiz_attempt'), compact( 'title', 'quiz', 'attempt', 'question', 'answered', 'q_number'));
    }

    public function answerSubmit(Request $request, $quiz_id){
        $user = Auth::user();

        if (is_array($request->questions) && count($request->questions)){
            $attempt = $user->get_attempt($quiz_id);

            foreach ($request->questions as $question_id => $answer) {
                $question = Question::find($question_id);
                $answer = is_string($answer) ? $answer : json_encode($answer);

                $is_correct = 0;
                $r_score = 0;

                if ($question->type === 'radio'){
                    $option = QuestionOption::whereQuestionId($question_id)->whereIsCorrect(1)->first();
                    if ($option && $option->id == $answer){
                        $is_correct = 1;
                        $r_score = $question->score;
                    }
                }elseif ($question->type === 'checkbox'){
                    $options = QuestionOption::whereQuestionId($question_id)->whereIsCorrect(1)->pluck('id')->toArray();
                    if ( ! count(array_diff($options, json_decode($answer, true)))){
                        $is_correct = 1;
                        $r_score = $question->score;
                    }
                }

                $answerData = [
                    'quiz_id'       => $quiz_id,
                    'question_id'   => $question_id,
                    'user_id'       => $user->id,
                    'attempt_id'    => $attempt->id,
                    'answer'        => $answer,
                    'q_type'        => $question->type,
                    'q_score'       => $question->score,
                    'r_score'       => $r_score,
                    'is_correct'    => $is_correct,
                ];
                Answer::create($answerData);
                session()->forget('current_question');
            }
        }

        return ['success' => 1, 'quiz_url' => route('quiz_attempt_url', $quiz_id)];
    }

    /**
     * @param Request $request
     * @param $course_id
     * @return array
     *
     * Dashboard Tasks
     */

    public function newQuiz(Request $request, $course_id){
        $rules = [
            'title' => 'required'
        ];

        $validation = Validator::make($request->input(), $rules);

        if ($validation->fails()){
            $errors = $validation->errors()->toArray();

            $error_msg = "<div class='alert alert-danger mb-3'>";
            foreach ($errors as $error){
                $error_msg .= "<p class='m-0'>{$error[0]}</p>";
            }
            $error_msg .= "</div>";

            return ['success' => false, 'error_msg' => $error_msg];
        }

        $user_id = Auth::user()->id;

        $lesson_slug = unique_slug($request->title, 'Content');
        $sort_order = next_curriculum_item_id($course_id);

        $data = [
            'user_id'       => $user_id,
            'course_id'     => $course_id,
            'section_id'    => $request->section_id,
            'title'         => clean_html($request->title),
            'slug'          => $lesson_slug,
            'text'          => clean_html($request->description),
            'item_type'     => 'quiz',
            'status'        => 1,
            'sort_order'   => $sort_order,
        ];

        $lecture = Content::create($data);
        $lecture->save_and_sync();

        return ['success' => true, 'item_id' => $lecture->id];
    }

    public function updateQuiz(Request $request, $course_id, $item_id){
        $rules = [
            'title' => 'required'
        ];
        $validation = Validator::make($request->input(), $rules);

        if ($validation->fails()){
            $errors = $validation->errors()->toArray();
            $error_msg = "<div class='alert alert-danger mb-3'>";
            foreach ($errors as $error){
                $error_msg .= "<p class='m-0'>{$error[0]}</p>";
            }
            $error_msg .= "</div>";
            return ['success' => false, 'error_msg' => $error_msg];
        }

        $user_id = Auth::user()->id;

        $lesson_slug = unique_slug($request->title, 'Content', $item_id);
        $data = [
            'title'         => clean_html($request->title),
            'slug'          => $lesson_slug,
            'text'          => clean_html($request->description),
            'options'       => json_encode($request->quiz_option),
            'quiz_gradable' => $request->quiz_gradable,
        ];

        $item = Content::find($item_id);
        $item->save_and_sync($data);

        return ['success' => true];
    }

    public function createQuestion(Request $request, $course_id, $quiz_id){
        $validation = Validator::make($request->input(), ['question_title' => 'required']);

        if ($validation->fails()){
            $errors = $validation->errors()->toArray();
            $error_msg = "<div class='alert alert-danger mb-3'>";
            foreach ($errors as $error){
                $error_msg .= "<p class='m-0'>{$error[0]}</p>";
            }
            $error_msg .= "</div>";
            return ['success' => false, 'error_msg' => $error_msg];
        }

        $user = Auth::user();
        $sort_order = $this->next_question_sort_id($quiz_id);

        $questionData = [
            'user_id'       => $user->id,
            'quiz_id'       => $quiz_id,
            'title'         => clean_html($request->question_title),
            'image_id'      => $request->image_id,
            'type'          => $request->question_type,
            'score'         => $request->score,
            'sort_order'   => $sort_order,
        ];

        $question = Question::create($questionData);

        if (is_array($request->options) && count($request->options)) {
            $options = array_except($request->options, '{index}');
            $sort = 0;
            foreach ($options as $option) {
                $sort++;

                if ($sort) {
                    $optionData = [
                        'question_id' => $question->id,
                        'title' => array_get($option, 'title'),
                        'image_id' => array_get($option, 'image_id'),
                        'd_pref' => array_get($option, 'd_pref'),
                        'is_correct' => (int)array_get($option, 'is_correct'),
                        'sort_order' => $sort,
                    ];
                    QuestionOption::create($optionData);
                }
            }
        }
        return ['success' => true, 'quiz_id' => $quiz_id];
    }


    public function loadQuestions(Request $request){
        $quiz = Content::find($request->quiz_id);
        $html = view_template_part( 'dashboard.courses.quiz.questions', compact('quiz'));
        return ['success' => 1, 'html' => $html];
    }

    public function editQuestion(Request $request){
        $question = Question::find($request->question_id);
        $html = view_template_part( 'dashboard.courses.quiz.edit_question', compact('question'));
        return ['success' => 1, 'html' => $html];
    }

    public function updateQuestion(Request $request){
        $validation = Validator::make($request->input(), ['question_title' => 'required']);

        if ($validation->fails()){
            $errors = $validation->errors()->toArray();
            $error_msg = "<div class='alert alert-danger mb-3'>";
            foreach ($errors as $error){
                $error_msg .= "<p class='m-0'>{$error[0]}</p>";
            }
            $error_msg .= "</div>";
            return ['success' => false, 'error_msg' => $error_msg];
        }

        $question_id = $request->question_id;

        $questionData = [
            'title' => clean_html($request->question_title),
            'image_id' => $request->image_id,
            'score' => $request->score,
        ];

        Question::whereId($question_id)->update($questionData);

        if (is_array($request->options) && count($request->options)) {
            $options = array_except($request->options, '{index}');

            $sort = 0;
            foreach ($options as $option) {
                $sort++;

                $option_id = array_get($option, 'option_id');
                $optionData = [
                    'question_id' => $question_id,
                    'title' => array_get($option, 'title'),
                    'image_id' => array_get($option, 'image_id'),
                    'd_pref' => array_get($option, 'd_pref'),
                    'is_correct' => (int)array_get($option, 'is_correct'),
                    'sort_order' => $sort,
                ];
                if ($option_id) {
                    QuestionOption::whereId($option_id)->update($optionData);
                } else {
                    QuestionOption::create($optionData);
                }
            }
        }
        $question = Question::find($request->question_id);

        return ['success' => true, 'quiz_id' => $question->quiz_id];
    }


    /**
     * @param Request $request
     *
     * Sort Quiz Questions
     */
    public function sortQuestions(Request $request){
        if (is_array($request->questions) && count($request->questions)){
            foreach ($request->questions as $short => $question){
                Question::whereId($question)->update(['sort_order' => $short]);
            }
        }
    }

    public function next_question_sort_id($quiz_id){
        $sort = (int) DB::table('questions')->where('quiz_id', $quiz_id)->max('sort_order');
        return $sort +1;
    }
    public function next_question_option_sort_id($question_id){
        $sort = (int) DB::table('question_options')->where('question_id', $question_id)->max('sort_order');
        return $sort +1;
    }

    public function deleteQuestion(Request $request){
        $question = Question::find($request->question_id);
        $question->delete_sync();
    }

    public function deleteOption(Request $request){
        QuestionOption::whereId($request->option_id)->delete();
    }


    /**
     * Dashboard Instructor review
     */

    public function quizCourses(){
        $title = __t('quiz_attempts');
        $user = Auth::user();
        $courses = $user->courses()->has('quizzes')->get();

        return view(theme('dashboard.quizzes.index'), compact('title', 'courses'));
    }

    public function quizzes($course_id){
        $title = __t('quizzes');
        $course = Course::find($course_id);
        return view(theme('dashboard.quizzes.quizzes'), compact('title', 'course'));
    }

    public function attempts($quiz_id){
        $title = __t('quiz_attempts');
        $quiz = Quiz::find($quiz_id);
        return view(theme('dashboard.quizzes.attempts'), compact('title', 'quiz'));
    }

    public function attemptDetail($attempt_id){
        $title = __t('review_attempt');
        $attempt = Attempt::find($attempt_id);
        return view(theme('dashboard.quizzes.attempt'), compact('title', 'attempt'));
    }

    public function attemptReview(Request $request, $attempt_id){

        $attempt = Attempt::find($attempt_id);

        if ( ! $attempt ){
            return redirect( route( 'courses_has_quiz' ) );
        }

        if ($request->review_btn === 'delete'){
            //Delete this attempt

            $content = Content::find($attempt->quiz_id);
            complete_content( $content, $attempt->user_id, 'delete' );

            $temp_attempt = $attempt;

            $attempt->delete();

            return redirect( route( 'quiz_attempts', $temp_attempt->quiz_id ) )->with( 'success', 'Attempt has been deleted' );
        }

        $user = Auth::user();

        if (is_array($request->answers) && count($request->answers)){
            foreach ($request->answers as $answer_id => $answer){
                $data = [
                    'r_score'       => array_get($answer, 'review_score'),
                    'is_correct'    => (int) array_get($answer, 'is_correct'),
                ];

                Answer::where('id', $answer_id)->update($data);
            }

            $attempt_review_data = [
                'reviewer_id'   => $user->id,
                'status'        => 'finished',
                'is_reviewed'   => 1,
                'reviewed_at'   => Carbon::now()->toDateTimeString(),
            ];
            $attempt->save_and_sync($attempt_review_data);
        }

        return back()->with('success', 'reviewed');
    }

    public function myQuizAttempts(){
        $title = __t('my_quiz_attempts');

        return view(theme('dashboard.quizzes.my_attempts'), compact('title'));
    }

}
