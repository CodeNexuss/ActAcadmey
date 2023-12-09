<?php

namespace App\Http\Controllers;

use App\AssignmentSubmission;
use App\Attachment;
use App\Category;
use App\Course;
use App\Review;
use App\Section;
use App\Content;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    /**
     * @return string
     *
     * View Course
     */

    public function view($slug){
        $course = Course::whereSlug($slug)->authorExist()->with('sections', 'sections.items', 'sections.items.attachments')->first();

        if ( ! $course){
            abort(404);
        }

        $user = Auth::user();

        if ( $course->status != 1){
            if ( ! $user || ! $user->isInstructorInCourse($course->id)){
                abort(404);
            }
        }
        $title = $course->title;
        $course->view_count++;
        $course->save();
        
        if($user) {
            $user->last_viewed_course = $course->id;
            $user->save();
        }

        $isEnrolled = false;
        if (Auth::check()){
            $user = Auth::user();

            $enrolled = $user->isEnrolled($course->id);
            if ($enrolled){
                $isEnrolled = $enrolled;
            }
        }
        return view(theme('course'), compact('course', 'title', 'isEnrolled'));
    }

    /**
     * @param $slug
     * @param $lecture_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * View lecture in full width mode.
     */
    public function lectureView($slug, $lecture_id){
        $lecture = Content::find($lecture_id);
        $course = $lecture->course;
        $title = $lecture->title;

        $isEnrolled = false;

        $isOpen = (bool) $lecture->is_preview;

        $user = Auth::user();

        if ($course->paid && $user){
            $isEnrolled = $user->isEnrolled($course->id);
            if ($course->paid && $isEnrolled){
                $isOpen = true;
            }
        }elseif ($course->free){
            if ($course->require_enroll && $user){
                $isEnrolled = $user->isEnrolled($course->id);
                if ($isEnrolled){
                    $isOpen = true;
                }
            }elseif ($course->require_login){
                if ($user)
                $isOpen = true;
            }else{
                $isOpen = true;
            }
        }

        if ($lecture->drip->is_lock){
            $isOpen = false;
        }

        //Mark, If an user is Super Admin.
        // if ( Auth::check() && $user->isAdmin() ){
        //     $isOpen = true;
        // }

        return view(theme('lecture'), compact('course', 'title', 'isEnrolled', 'lecture', 'isOpen'));
    }

    public function assignmentView($slug, $assignment_id){
        $assignment = Content::find($assignment_id);
        $course = $assignment->course;
        $title = $assignment->title;
        $has_submission = $assignment->has_submission;

        $isEnrolled = false;
        $isEnrolledAssignment = false;
        if (Auth::check()){
            $user = Auth::user();

            // if($user->isAdmin()) {
            //     $isEnrolled = true;
            //     $isEnrolledAssignment = false;
            // } else {
            //     $isEnrolled = ($assignment->drip->is_lock) ? false : $user->isEnrolled($course->id);
            //     $isEnrolledAssignment = $user->isEnrolled($course->id);
            // }

            $isEnrolled = ($assignment->drip->is_lock) ? false : $user->isEnrolled($course->id);
            $isEnrolledAssignment = $user->isEnrolled($course->id);
        }

        return view(theme('assignment'), compact('course', 'title', 'isEnrolled', 'assignment', 'has_submission', 'isEnrolledAssignment'));
    }

    public function assignmentSubmitting(Request $request, $slug, $assignment_id){
        $user = Auth::user();
        $user_id = $user->id;
        $assignment = Content::find($assignment_id);

        $submission = $assignment->has_submission;
        if ($submission){
            if ($submission->status === 'submitting'){

                $submission->text_submission = clean_html($request->assignment_text);
                $submission->status = 'submitted';
                $submission->save();
                complete_content($assignment, $user);

                /**
                 * Save Attachments if any
                 *
                 * @todo, check attachment size, if exceed, delete those attachments
                 */
                $attachments = array_filter( (array) $request->assignment_attachments);
                if (is_array($attachments) && count($attachments) ){
                    foreach ($attachments as $media_id){
                        $hash = strtolower(str_random(13).substr(time(),4).str_random(13));
                        Attachment::create(['assignment_submission_id' => $submission->id, 'user_id' => $user_id, 'media_id' => $media_id, 'hash_id' => $hash ]);
                    }
                }
            }

        }else {
            $course = $assignment->course;
            $data = [
                'user_id' => $user_id,
                'course_id' => $course->id,
                'assignment_id' => $assignment_id,
                'status' => 'submitting',
            ];
            AssignmentSubmission::create($data);
        }

        return redirect()->back();
    }


    public function create(){
        $title = __t('create_new_course');
        $categories = Category::parent()->get();

        return view(theme('dashboard.courses.create_course'), compact('title', 'categories'));
    }

    public function store(Request $request){
        $rules = [
            'title' => 'required',
            'category_id' => 'required',
            'topic_id' => 'required',
        ];

        $this->validate($request, $rules);

        $user_id = Auth::user()->id;
        $slug = unique_slug($request->title);
        $now = Carbon::now()->toDateTimeString();

        $category = Category::find($request->category_id);
        $data = [
            'user_id'           => $user_id,
            'title'             => clean_html($request->title),
            'slug'              => $slug,
            'short_description' => clean_html($request->short_description),
            'price_plan'        => 'free',
            'category_id'       => $request->topic_id,
            'parent_category_id' => $category->category_id,
            'second_category_id' => $category->id,
            'thumbnail_id'      => $request->thumbnail_id,
            'level'             => $request->level,
            'last_updated_at'   => $now,
        ];

        /**
         * save video data
         */
        $video_source = $request->input('video.source');
        if ($video_source === '-1'){
            $data['video_src'] = null;
        }else{
            $data['video_src'] = json_encode($request->video);
        }

        $course = Course::create($data);

        $now = Carbon::now()->toDateTimeString();
        if ($course){
            $course->instructors()->attach($user_id, ['added_at' => $now]);
        }

        return redirect(route('edit_course_information', $course->id));
    }

    public function information($course_id){
        $title = __t('information');
        $course = Course::find($course_id);
        if ( ! $course || ! $course->i_am_instructor){
            abort(404);
        }
        $categories = Category::parent()->get();
        $topics = Category::whereCategoryId($course->second_category_id)->get();
        return view(theme('dashboard.courses.information'), compact('title', 'course', 'categories', 'topics'));
    }

    public function informationPost( Request $request, $course_id){
        $rules = [
            'title'             => 'required|max:120',
            'short_description' => 'max:220',
            'category_id'       => 'required',
            'topic_id'       => 'required',
        ];
        $this->validate($request, $rules);

        $course = Course::find($course_id);
        if ( ! $course || ! $course->i_am_instructor){
            abort(404);
        }
        $category = Category::find($request->category_id);

        $data = [
            'title'             => clean_html($request->title),
            'short_description' => clean_html($request->short_description),
            'description'       => clean_html($request->description),
            'benefits'          => clean_html($request->benefits),
            'requirements'      => clean_html($request->requirements),
            'thumbnail_id'      => $request->thumbnail_id,
            'category_id'       => $request->topic_id,
            'parent_category_id' => $category->category_id,
            'second_category_id' => $category->id,
            'level'             => $request->level,
        ];
        /**
         * save video data
         */
        $video_source = $request->input('video.source');
        if ($video_source === '-1'){
            $data['video_src'] = null;
        }else{
            $data['video_src'] = json_encode($request->video);
        }

        $course->update($data);

        if ($request->save === 'save_next')
            return redirect(route('edit_course_curriculum', $course_id));
        return redirect()->back();
    }

    public function curriculum($course_id){
        $title = __t('curriculum');
        $course = Course::find($course_id);
        if ( ! $course || ! $course->i_am_instructor){
            abort(404);
        }

        return view(theme('dashboard.courses.curriculum'), compact('title', 'course'));
    }


    public function newSection($course_id){
        $title = __t('curriculum');
        $course = Course::find($course_id);
        return view(theme('dashboard.courses.new_section'), compact('title', 'course'));
    }

    public function newSectionPost(Request $request, $course_id){
        $rules = [
            'section_name' => 'required',
        ];
        $this->validate($request, $rules);

        Section::create([
                'course_id' => $course_id,
                'section_name' => clean_html($request->section_name)
            ]
        );
        return redirect(route('edit_course_curriculum', $course_id));
    }

    /**
     * @param Request $request
     * @param $id
     * @throws \Illuminate\Validation\ValidationException
     *
     * Update the section
     */
    public function updateSection(Request $request, $id){
        $rules = [
            'section_name' => 'required',
        ];
        $this->validate($request, $rules);

        Section::whereId($id)->update(['section_name' => clean_html($request->section_name)]);
    }

    public function deleteSection(Request $request){
        if(is_live_env()) return ['success' => false, 'msg' => __t('demo_restriction')];

        $section = Section::find($request->section_id);
        $course = $section->course;

        Content::query()->where('section_id', $request->section_id)->delete();
        $section->delete();
        $course->sync_everything();

        return ['success' => true];
    }

    public function newLecture(Request $request, $course_id){
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
            'item_type'     => 'lecture',
            'status'        => 1,
            'sort_order'   => $sort_order,
            'is_preview'    => $request->is_preview,
        ];

        $lecture = Content::create($data);
        $lecture->save_and_sync();

        return ['success' => true, 'item_id' => $lecture->id];
    }

    public function loadContents(Request $request){
        $section = Section::find($request->section_id);

        $html = view_template_part('dashboard.courses.section-items', compact('section'));

        return ['success' => true, 'html' => $html];
    }

    public function updateLecture(Request $request, $course_id, $item_id){
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
            'is_preview'    => clean_html($request->is_preview),
        ];

        /**
         * save video data
         */
        $video_source = $request->input('video.source');
        if ($video_source === '-1'){
            $data['video_src'] = null;
        }else{
            $data['video_src'] = json_encode($request->video);
        }

        $item = Content::find($item_id);
        $item->save_and_sync($data);

        /**
         * Save Attachments if any
         */
        $attachments = array_filter( (array) $request->attachments);
        if (is_array($attachments) && count($attachments) ){
            foreach ($attachments as $media_id){
                $hash = strtolower(str_random(13).substr(time(),4).str_random(13));
                Attachment::create(['belongs_course_id' => $item->course_id, 'content_id' => $item->id, 'user_id' => $user_id, 'media_id' => $media_id, 'hash_id' => $hash ]);
            }
        }

        return ['success' => true];
    }


    public function editItem(Request $request){
        $item_id = $request->item_id;
        $item = Content::find($item_id);

        $form_html = '';

        if ($item->item_type === 'lecture'){
            $form_html = view_template_part( 'dashboard.courses.edit_lecture_form', compact('item'));
        }elseif ($item->item_type === 'quiz'){
            $form_html = view_template_part( 'dashboard.courses.quiz.edit_quiz', compact('item'));
        }elseif ($item->item_type === 'assignment'){
            $form_html = view_template_part( 'dashboard.courses.edit_assignment_form', compact('item'));
        }

        return ['success' => true, 'form_html' => $form_html];
    }

    public function deleteItem(Request $request){
        $item_id = $request->item_id;
        Content::destroy($item_id);
        return ['success' => true];
    }

    public function pricing($course_id){
        $title = __t('course_pricing');
        $course = Course::find($course_id);
        if ( ! $course || ! $course->i_am_instructor){
            abort(404);
        }

        return view(theme('dashboard.courses.pricing'), compact('title', 'course'));
    }

    public function pricingSet(Request $request,  $course_id){

        if ($request->price_plan == 'paid'){
            $rules = [
                'price' => 'required|numeric',
            ];
            if ($request->sale_price){
                $rules['sale_price'] = 'numeric';
            }
            $this->validate($request, $rules);
        }

        $course = Course::find($course_id);
        if ( ! $course || ! $course->i_am_instructor){
            abort(404);
        }

        $data = [
            'price_plan'        => $request->price_plan,
            'price'             => clean_html($request->price),
            'sale_price'        => clean_html($request->sale_price),
            'require_login'     => $request->require_login,
            'require_enroll'    => $request->require_enroll,
        ];

        $course->update($data);

        return back();
    }

    public function drip($course_id){
        $title = __t('drip_content');
        $course = Course::find($course_id);
        if ( ! $course || ! $course->i_am_instructor){
            abort(404);
        }

        return view(theme('dashboard.courses.drip'), compact('title', 'course'));
    }
    public function dripPost(Request $request, $course_id){

        $sections = $request->section;
        // dd($request->all());
        foreach ($sections as $sectionId => $section){
            if(!isset($section['unlock_days']) || $section['unlock_days'] == '') {
                $section['unlock_days'] = 0;
            }
            Section::whereId($sectionId)->update(array_except($section, 'content'));

            if($section['unlock_days'] > 0) {
                Content::where('section_id', $sectionId)->update(array_except(['unlock_days' => $section['unlock_days']], 'content'));
            } else {
                $contents = array_get($section, 'content');
                if($contents) {
                    foreach ($contents as $contentId => $content){
                        if($content['unlock_days'] == '') {
                            $content['unlock_days'] = 0;
                        }
                        Content::whereId($contentId)->update(array_except($content, 'content'));
                    }
                } else {
                    Content::where('section_id', $sectionId)->update(['unlock_days' => $section['unlock_days']]);
                }
            }
        }

        return back()->with('success', __t('drip_preference_saved'));
    }



    public function publish($course_id){
        $title = __t('publish_course');
        $course = Course::find($course_id);
        if ( ! $course || ! $course->i_am_instructor){
            abort(404);
        }

        return view(theme('dashboard.courses.publish'), compact('title', 'course'));
    }

    public function publishPost(Request $request, $course_id){
        $course = Course::find($course_id);
        if ( ! $course || ! $course->i_am_instructor){
            abort(404);
        }
        if ($request->publish_btn == 'publish'){
            if (get_option("lms_settings.instructor_can_publish_course")){
                $course->status = 1;
            }else{
                $course->status = 2;
            }
        }elseif ($request->publish_btn == 'unpublish'){
            $enrolled = \App\Enroll::where('course_id', $course_id)->first();
            if($enrolled) {
                return back()->with('error', __t('failed_unpublish_already_enrolled'));
            }
            $course->status = 4;
        }

        $course->save();

        return back();
    }


    /**
     * Course Free Enroll
     */

    public function freeEnroll(Request $request){
        $course_id = $request->course_id;

        if ( ! Auth::check()){
            return redirect(route('login'));
        }

        $user = Auth::user();
        $course = Course::find($course_id);

        $isEnrolled = $user->isEnrolled($course_id);

        if ( ! $isEnrolled){
            $carbon = Carbon::now()->toDateTimeString();
            $user->enrolls()->attach($course_id, ['status' => 'success', 'enrolled_at' => $carbon ]);
            $user->enroll_sync();

            $course->total_sales++;
            $course->save();
        }

        return redirect(route('course', $course->slug));
    }

    /**
     * Content Complete, such as Lecture
     * return to next after complete
     * stay current page if there is no next.
     */
    public function contentComplete($content_id){
        $content = Content::find($content_id);
        $user = Auth::user();

        complete_content($content, $user);

        $go_content = $content->next;
        if ( ! $go_content){
            $go_content = $content;
        }

        return redirect(route('single_'.$go_content->item_type, [$go_content->course->slug, $go_content->id ] ));
    }

    public function complete(Request $request, $course_id){
        $user = Auth::user();
        $user->complete_course($course_id);

        return back();
    }

    public function attachmentDownload($hash){
        $attachment = Attachment::whereHashId($hash)->first();
        if ( ! $attachment ||  ! $attachment->media){
            abort(404);
        }

        /**
         * If Assignment Submission Attachment, download it right now
         */
        if ($attachment->assignment_submission_id){
            if (Auth::check()){
                return $this->forceDownload($attachment->media);
            }
            abort(404);
        }

        $item = $attachment->belongs_item;

        if ($item && $item->item_type === 'lecture' && $item->is_preview){
            return $this->forceDownload($attachment->media);
        }

        if ( ! Auth::check()){
            abort(404);
        }
        $user = Auth::user();

        $course = $attachment->course;

        if ( ! $user->isEnrolled($course->id)){
            abort(404);
        }

        return $this->forceDownload($attachment->media);
    }

    public function forceDownload($media){
        $source = get_option('default_storage');
        $slug_ext = $media->slug_ext;

        if (substr($media->mime_type, 0, 5) == 'image') {
            $slug_ext = 'images/'.$slug_ext;
        }

        $path = '';
        if ($source == 'public'){
            $path = ROOT_PATH."/uploads/{$slug_ext}";
        }elseif ($source == 's3'){
            $path = \Illuminate\Support\Facades\Storage::disk('s3')->url("uploads/".$slug_ext);
        }

        return response()->download($path);
    }

    public function writeReview(Request $request, $id){
        if ($request->rating_value < 1){
            return back();
        }
        if ( ! $id){
            $id = $request->course_id;
        }

        $user = Auth::user();

        $data = [
            'user_id'       => $user->id,
            'course_id'     => $id,
            'review'        => clean_html($request->review),
            'rating'        => $request->rating_value,
            'status'        => 1,
        ];

        $review = has_review($user->id, $id);
        if ( ! $review){
            $review = Review::create($data);
        }
        $review->save_and_sync($data);

        return back();
    }

    /**
     * My Courses page from Dashboard
     */

    public function myCourses(){
        $title = __t('my_courses');
        return view(theme('dashboard.my_courses'), compact('title'));
    }

    public function myCoursesReviews(){
        $title = __t('my_courses_reviews');
        return view(theme('dashboard.my_courses_reviews'), compact('title'));
    }

}
