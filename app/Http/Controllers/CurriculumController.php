<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CurriculumController extends Controller
{

    public function sort(Request $request){
        //sections

        if (is_array($request->sections) && count($request->sections)){
            $item_i = 1;

            foreach ($request->sections as $skey => $section){
                $section_id = array_get($section, 'section_id');
                //Sorting Section
                DB::table('sections')->whereId($section_id)->update(['sort_order' => $skey]);

                $item_ids = array_get($section, 'item_ids');
                if (is_array($item_ids) && count($item_ids)){
                    foreach ($item_ids as $ikey => $item_id){
                        DB::table('contents')->whereId($item_id)->update(['section_id'=> $section_id, 'sort_order' => $item_i]);
                        $item_i++;
                    }
                }

            }
        }

    }

    /**
     * @param Request $request
     * @param $course_id
     * @return array
     *
     * Save New Assignment
     */
    public function newAssignment(Request $request, $course_id){
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
        $assignment_option = json_encode($request->assignment_option);

        $data = [
            'user_id'       => $user_id,
            'course_id'     => $course_id,
            'section_id'    => $request->section_id,
            'title'         => clean_html($request->title),
            'slug'          => $lesson_slug,
            'text'          => clean_html($request->description),
            'item_type'     => 'assignment',
            'status'        => 1,
            'sort_order'   => $sort_order,
            'options'   => $assignment_option,
        ];

        $assignment = Content::create($data);


        /**
         * Save Attachments if any
         */
        $attachments = array_filter( (array) $request->attachments);
        if (is_array($attachments) && count($attachments) ){
            foreach ($attachments as $media_id){
                $hash = strtolower(str_random(13).substr(time(),4).str_random(13));
                Attachment::create(['belongs_course_id' => $course_id, 'content_id' => $assignment->id, 'user_id' => $user_id, 'media_id' => $media_id, 'hash_id' => $hash ]);
            }
        }

        return ['success' => true, 'item_id' => $assignment->id];
    }

    public function updateAssignment(Request $request, $course_id, $assignment_id){

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

        $lesson_slug = unique_slug($request->title, 'Content', $assignment_id);
        $assignment_option = json_encode($request->assignment_option);

        $data = [
            'title'         => clean_html($request->title),
            'slug'          => $lesson_slug,
            'text'          => clean_html($request->description),
            'options'       => $assignment_option,
        ];

        $item = Content::find($assignment_id);
        $item->update($data);

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

    /**
     * @param Request $request
     * @return array
     *
     * Delete Attachment IDS
     */
    public function deleteAttachment(Request $request){
        Attachment::destroy($request->attachment_id);
        return ['success' => true];
    }


}
