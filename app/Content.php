<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Content extends Model
{
    protected $guarded = [];

    public function course(){
        return $this->belongsTo(Course::class)->with('sections', 'sections.items');
    }

    public function section(){
        return $this->belongsTo(Section::class);
    }

    public function questions(){
        return $this->hasMany(Question::class, 'quiz_id')->with('media')->orderBy('sort_order', 'asc');
    }

    public function attempts(){
        return $this->hasMany(Attempt::class, 'quiz_id');
    }

    /**
     * @param null $key
     * @return mixed|null
     *
     * Get Attached Video Info
     */

    public function video_info($key = null){
        $video_info = null;
        if ($this->video_src){
            $video_info = json_decode($this->video_src, true);
        }
        if ($key && is_array($video_info)){
            return array_get($video_info, $key);
        }

        return $video_info;
    }
    public function getUrlAttribute(){
        if ($this->item_type === 'lecture'){
            return route('single_lecture', [$this->course_id, $this->id]);
        }elseif ($this->item_type === 'assignment'){
            return route('single_assignment', [$this->course_id, $this->id]);
        }elseif ($this->item_type === 'quiz'){
            return route('single_quiz', [$this->course_id, $this->id]);
        }
        return null;
    }
    public function getRuntimeSecondsAttribute(){
        $hours = (int) $this->video_info('runtime.hours') * 3600;
        $mins = (int) $this->video_info('runtime.mins') * 60;
        $secs = (int) $this->video_info('runtime.secs');

        return $hours + $mins + $secs;
    }

    public function getRuntimeAttribute(){
        $seconds = $this->runtime_seconds;
        if ($seconds){
            return seconds_to_time_format($this->runtime_seconds);
        }
        return false;
    }

    public function option($key = null, $default = null){
        $options = null;
        if ($this->options){
            $options = json_decode($this->options, true);
        }
        if ($key){
            if (is_array($options) && array_get($options, $key)){
                return array_get($options, $key);
            }else{
                return $default;
            }
        }

        return $options;
    }

    public function attachments(){
        return $this->hasMany(Attachment::class);
    }

    public function getIconHtmlAttribute(){
        $icon_class = 'file-text';

        if ($this->video_src){
            $icon_class = 'youtube';
        }
        if ($this->item_type === 'assignment'){
            $icon_class = 'clipboard';
        }
        if ($this->item_type === 'quiz'){
            $icon_class = 'tasks';
        }

        return "<i class='la la-{$icon_class}'></i> ";
    }

    public function has_submission($user_id = 0){
        if ( ! $user_id && Auth::check()){
            $user_id = Auth::user()->id;
        }
        return $this->hasOne(AssignmentSubmission::class, 'assignment_id')->where('user_id', $user_id);
    }

    public function submissions(){
        return $this->hasMany(AssignmentSubmission::class, 'assignment_id');
    }

    public function previous(){
        return $this->hasOne(Content::class, 'course_id', 'course_id')->where('sort_order', $this->sort_order-1)->orderBy('sort_order', 'desc');
    }
    public function next(){
        return $this->hasOne(Content::class, 'course_id', 'course_id')->where('sort_order', $this->sort_order+1)->orderBy('sort_order', 'asc');
    }

    public function is_completed(){
        if (Auth::user()){
            $user_id = Auth::user()->id;
            return $this->hasOne(Complete::class)->whereUserId($user_id);
        }
        return false;
    }

    /**
     * @param array $data
     * @return $this
     *
     * Save content and sync to all necessary place
     */

    public function save_and_sync($data = []){
        if (is_array($data) && count($data)){
            $data['video_time'] = $this->runtime_seconds;
            $this->update($data);
        }else{
            $this->video_time = $this->runtime_seconds;
            $this->save();
        }

        $this->course->sync_everything();

        return $this;
    }


    /**
     * Content Drip
     */


    public function enrolled_course(){
        if ( ! Auth::check()){
            return null;
        }

        $user_id = Auth::check();
        return $this->hasOne(Enroll::class, 'course_id', 'course_id')->where('user_id', $user_id)->where('status', 'success');
    }

    public function getDripAttribute(){
        $section_drip = $this->section->drip;

        $data = [
            'is_lock' => false,
            'message' => null,
        ];

        /**
         * If Section is Lock
         */
        if ($section_drip->is_lock){

            $data['is_lock'] = true;
            $data['message'] = $section_drip->message;

            return (object) $data;
        }

        /**
         * If Lock by date
         */

        $time = Carbon::now()->timestamp;

        if ($this->unlock_date && strtotime($this->unlock_date) > $time ){
            $unlock_date = Carbon::parse($this->unlock_date)->format(get_option('date_format'));

            $data['is_lock'] = true;
            $data['message'] = ' The content will become available at '.$unlock_date;
        }

        /**
         * If Lock by Days
         */
        // if ($this->unlock_days && $this->unlock_days > 0 ) {
        //     if ( Auth::check() ) {
        //         $user = Auth::user();

        //         $isEnrol = $user->isEnrolled( $this->course_id );

        //         if ( $isEnrol ) {
        //             $unlock_date = Carbon::parse( $isEnrol->enrolled_at )->addDays( $this->unlock_days );
        //         } else {
        //             $unlock_date = Carbon::now()->addDays( $this->unlock_days );
        //         }
        //         $now = Carbon::now();

        //         // dd($now->format('Y-m-d'), $now, $unlock_date->format('Y-m-d'), $unlock_date->diffInDays( $now ));

        //         if ( $unlock_date->diffInDays( $now ) > 0 ) {
        //             $diffDays          = $unlock_date->diffInDays( $now );
        //             $data[ 'is_lock' ] = true;
        //             $data[ 'message' ] = "The content will become available in {$diffDays} days";
        //         }
        //     }
        // }


        if ($this->unlock_days && $this->unlock_days > 0 ) {
            if ( Auth::check() ) {
                $user = Auth::user();

                $isEnrol = $user->isEnrolled( $this->course_id );

                if ( $isEnrol ) {
                    // $unlock_date = Carbon::parse( $isEnrol->enrolled_at )->addDays( $this->unlock_days );
                    $unlock_date = date('Y-m-d', strtotime( date('Y-m-d', strtotime($isEnrol->enrolled_at))  . ' + '.$this->unlock_days.' days'));
                } else {
                    // $unlock_date = Carbon::now()->addDays( $this->unlock_days );
                    $unlock_date = date('Y-m-d', strtotime(date('Y-m-d') . ' + '.$this->unlock_days.' days'));
                }
                // $now = Carbon::now();
                $now = date('Y-m-d');

                $unlock_date = new \DateTime($unlock_date);
                $now = new \DateTime($now);
                $interval = $now->diff($unlock_date);
                $interval = (int) $interval->format("%r%a");

                if ( $interval > 0 ) {
                    // $diffDays          = $unlock_date->diffInDays( $now );
                    $data[ 'is_lock' ] = true;
                    $data[ 'message' ] = "The content will become available in ".$interval." days";
                }
            }
        }

        return (object) $data;
    }


    public function discussions(){
        return $this->hasMany(Discussion::class)->with('user', 'replies', 'user.photo_query')->where('discussion_id', 0);
    }

}
