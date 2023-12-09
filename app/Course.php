<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    protected $guarded = [];
    protected $casts = [
        'last_updated_at'   => 'datetime',
    ];
    // public $appends = [
    //     'author_exist'
    // ];

    public function scopePublish($query){
        return $query->where('status', 1)->with('media', 'author', 'category');
    }

    public function scopeAuthorExist($query){
        return $query->whereHas('author', function($qry) {
            $qry->where('id', '!=', NULL);
        });
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
    // public function getAuthorExistAttribute(){
    //     return $this->author() != null ? true : false;
    // }
    public function instructors(){
        return $this->belongsToMany(User::class)->withPivot('added_at');
    }
    public function students(){
        return $this->belongsToMany(User::class, 'enrolls')->where('status', 'success')->withPivot('enrolled_at');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function second_category(){
        return $this->belongsTo(Category::class, 'second_category_id');
    }
    public function sections(){
        return $this->hasMany(Section::class)->orderBy('sort_order', 'asc');
    }
    public function lectures(){
        return $this->hasMany(Content::class)->whereItemType('lecture');
    }
    public function assignments(){
        return $this->hasMany(Content::class)->whereItemType('assignment');
    }
    public function quizzes(){
        return $this->hasMany(Content::class)->whereItemType('quiz');
    }
    public function quiz_attempts(){
        return $this->hasMany(Attempt::class);
    }
    public function assignment_submissions(){
        return $this->hasMany(AssignmentSubmission::class);
    }
    public function assignment_submissions_waiting(){
        return $this->hasMany(AssignmentSubmission::class)->where('is_evaluated', '<', 1);
    }

    public function contents(){
        return $this->hasMany(Content::class);
    }
    public function contents_attachments(){
        return $this->hasMany(Attachment::class, 'belongs_course_id', 'id');
    }
    /**
     * Delete Event
     */
    public function delete_and_sync(){
        DB::table('course_user')->where('course_id', $this->id)->delete();
        $this->sections()->delete();
        $this->contents()->delete(); //Delete lecture, assignments, quiz
        $this->contents_attachments()->delete();
        $this->assignment_submissions()->delete();
        DB::table('completes')->where('course_id', $this->id)->delete();
        DB::table('completes')->whereCourseId('completed_course_id', $this->id)->delete();
        $this->delete();
        return $this;
    }

    /**
     * Sync anytime With Contents
     */
    public function sync_everything(){
        $now = Carbon::now()->toDateTimeString();

        $course = $this;
        $course_runtime = $course->lectures->sum('video_time');
        $total_lectures = $course->lectures->count();
        $total_assignments = $course->assignments->count();
        $total_quiz = $course->quizzes->count();

        $course->total_video_time = $course_runtime;
        $course->total_lectures = $total_lectures;
        $course->total_assignments = $total_assignments;
        $course->total_quiz = $total_quiz;
        $course->last_updated_at = $now;
        $course->save();
    }

    public function media(){
        return $this->belongsTo(Media::class, 'thumbnail_id');
    }
    public function getUrlAttribute(){
        return route('course', $this->slug);
    }
    public function getThumbnailUrlAttribute(){
        return media_image_uri($this->media)->image_sm;
    }
    public function getIAmInstructorAttribute(){
        if ( ! Auth::check()){
            return false;
        }
        $user_id = Auth::user()->id;
        return $this->instructors->contains($user_id);
    }

    public function getLevelAttribute($value){
        return (int) $value;
    }
    public function getPaidAttribute($value){
        return $this->price_plan === 'paid';
    }
    public function getFreeAttribute($value){
        return $this->price_plan === 'free';
    }
    public function completed_percent($user = null){
        /**
         * If not passed user id, get user id from auth
         * if auth user is not available, return percent 0;
         */

        if ( ! $user){
            $user = Auth::user();
        }
        if ( ! $user instanceof User) {
            $user = \App\User::find($user);
        }

        if(! $user) {
            return 0;
        }

        $completed_course = (array) $user->get_option('completed_courses');
        return (int) array_get($completed_course, $this->id.".percent");

        /*
        $total_contents = (int) Content::whereCourseId($this->id)->count();
        $total_completed = (int) Complete::whereUserId($user->id)->whereCourseId($this->id)->count();

        if ( ! $total_contents || ! $total_completed){
            return 0;
        }

        return (int) number_format(($total_completed * 100 ) / $total_contents);

        */
    }

    public function getBenefitsArrAttribute(){
        if ( ! $this->benefits){
            return null;
        }
        $newArr = array();
        if ($this->benefits){
            $newArr = explode("\n", $this->benefits);
        }
        $Arr = array_filter(array_map('trim', $newArr));
        return $Arr;
    }

    public function getRequirementsArrAttribute(){
        if ( ! $this->requirements){
            return null;
        }
        $newArr = array();
        if ($this->requirements){
            $newArr = explode("\n", $this->requirements);
        }
        $Arr = array_filter(array_map('trim', $newArr));
        return $Arr;
    }

    public function getContinueUrlAttribute(){
        if ( ! Auth::check()){
            return null;
        }

        $user_id = Auth::user()->id;
        $completed_ids = Complete::whereUserId($user_id)->whereCourseId($this->id)->pluck('content_id')->toArray();

        $content = Content::whereCourseId($this->id)->whereNotIn('id', $completed_ids)->orderBy('sort_order', 'asc')->first();

        if ( ! $content){
            $content = Content::whereCourseId($this->id)->orderBy('sort_order', 'asc')->first();
        }
        if ( ! $content){
            return null;
        }
        return route('single_'.$content->item_type, [$this->slug, $content->id ] );
    }

    public function getGetPriceAttribute(){
        if ($this->price_plan && $this->price_plan !== 'free' && $this->price > 0){
            $current_price = $this->sale_price > 0 ?  $this->sale_price : $this->price;

            return $current_price;
        }
        return 0;
    }

    public function price_html($originalPriceOnRight = false, $showOff = false){

        $priceLocation = ' current-price-left ';
        if ($originalPriceOnRight){
            $priceLocation = ' current-price-right ';
        }

        $price_html = "<div class='price-html-wrap {$priceLocation}'>";
        if ( $this->paid && $this->price > 0){

            $current_price = $this->sale_price > 0 ?  price_format($this->sale_price) : price_format($this->price);

            if ( ! $originalPriceOnRight){
                $price_html .= " <span class='current-price'>{$current_price}</span>";
            }

            if ($this->sale_price > 0){
                $old_price = price_format($this->price);
                $price_html .= " <span class='old-price'><s>{$old_price}</s></span>";

                if ($showOff) {
                    $discount = number_format( 100 - ($this->sale_price * 100   / $this->price)   , 2);
                    $offText = $discount . '% ' . __t('off');
                    $price_html .= " <span class='discount-text mr-2'>{$offText}</span>";
                }
            }

            if ($originalPriceOnRight){
                $price_html .= " <span class='current-price'>{$current_price}</span>";
            }


        }else{
            $price_html .= '<span class="free-text mr-2">'.__t('free').'</span>';
        }
        $price_html .= '</div>';

        return $price_html;
    }

    public function status_html($badge = true){
        $status = $this->status;

        $class = $badge ? 'badge badge' : 'status-text text';

        $html = "<span class='{$class}-dark'> <i class='la la-pencil-square-o'></i> ".__t('draft')."</span>";

        switch ($status){
            case 1:
                $html = "<span class='{$class}-success'> <i class='la la-check-circle'></i> ".__t('published')."</span>";
                break;
            case 2:
                $html = "<span class='{$class}-info'> <i class='la la-clock-o'></i> ".__t('pending')."</span>";
                break;
            case 3:
                $html = "<span class='{$class}-danger'> <i class='la la-ban'></i> ".__t('blocked')."</span>";

                break;
            case 4:
                $html = "<span class='{$class}-warning'> <i class='la la-exclamation-circle'></i> ".__t('unpublished')."</span>";
                break;
        }

        if ($this->is_popular){
            $html .= "<span class='badge badge-primary mx-1' data-toggle='tooltip' title='".__t('popular')."'> <i class='la la-bolt'></i></span>";
        }
        if ($this->is_featured){
            $html .= "<span class='badge badge-info mx-1'  data-toggle='tooltip' title='".__t('featured')."'> <i class='la la-bookmark'></i></span>";
        }
        if ($this->is_top){
            $html .= "<span class='badge badge-secondary mx-1'  data-toggle='tooltip' title='".__t('top')."'> <img src='".url("uploads/images/top-menu.png")."' height=11/> </span>";
        }

        return $html;
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

    public function reviews(){
        return $this->hasMany(Review::class)->whereStatus(1)->with('user')->orderBy('id', 'desc');
    }

    public function get_ratings($key = null){

        $ratingCount = $this->rating_count;

        $five_percent = 0;
        if ($this->five_star_count > 0){
            $five_percent = ($this->five_star_count * 100) / $ratingCount;
        }
        $four_percent = 0;
        if ($this->four_star_count > 0){
            $four_percent = ($this->four_star_count * 100) / $ratingCount;
        }
        $three_percent = 0;
        if ($this->three_star_count > 0){
            $three_percent = ($this->three_star_count * 100) / $ratingCount;
        }
        $two_percent = 0;
        if ($this->two_star_count > 0){
            $two_percent = ($this->two_star_count * 100) / $ratingCount;
        }
        $one_percent = 0;
        if ($this->one_star_count > 0){
            $one_percent = ($this->one_star_count * 100) / $ratingCount;
        }

        $ratings = [
            'rating_count'  => $ratingCount,
            'rating_avg'    => $this->rating_value,
            'stats'    => [
                5 => [
                    'count'    => $this->five_star_count,
                    'percent'  => number_format($five_percent),
                ],
                4 => ['count'    => $this->four_star_count,
                    'percent'  => number_format($four_percent),
                ],
                3 => ['count'   => $this->three_star_count,
                    'percent' => number_format($three_percent),
                ],
                2 => ['count'     => $this->two_star_count,
                    'percent'   => number_format($two_percent),
                ],
                1 => ['one_count'     => $this->one_star_count,
                    'percent'   => number_format($one_percent),
                ]
            ]
        ];

        if ($key){
            return array_get($ratings, $key);
        }

        return $ratings;
    }

    public function getDripItemsAttribute(){
        $dripItems = [
            'sections' => [],
            'contents' => [],
        ];

        if ( ! Auth::check()){
            return $dripItems;
        }

        $dripSectionIds = [];
        $dripContentIds = [];
        $dripSections = $this->sections()->where('unlock_date', '!=', null)->orWhere('unlock_days', '>', 0)->get();
        $dripContents = $this->contents()->where('unlock_date', '!=', null)->orWhere('unlock_days', '>', 0)->get();


        $time = Carbon::now()->timestamp;
        $user = Auth::user();
        $isEnrol = $user->isEnrolled($this->id);

        foreach ($dripSections as $dripSection){
            if ($dripSection->unlock_date && strtotime($dripSection->unlock_date) > $time ){
                $dripSectionIds[] = $dripSection->id;
            }elseif ($dripSection->unlock_days && $dripSection->unlock_days > 0 ){
                if( $isEnrol ) {
                    $unlock_date = Carbon::parse($isEnrol->enrolled_at)->addDays($dripSection->unlock_days);
                } else {
                    $unlock_date = Carbon::now()->addDays( $dripSection->unlock_days );
                }
                $now = Carbon::now();

                if ($unlock_date->gt($now)){
                    $dripSectionIds[] = $dripSection->id;
                }
            }
        }

        foreach ($dripContents as $dripContent){
            if ($dripContent->unlock_date && strtotime($dripContent->unlock_date) > $time ){
                $dripContentIds[] = $dripContent->id;
            }elseif ($dripContent->unlock_days && $dripContent->unlock_days > 0 ){

                if ( $isEnrol ) {
                    $unlock_date = Carbon::parse( $isEnrol->enrolled_at )->addDays( $this->unlock_days );
                } else {
                    $unlock_date = Carbon::now()->addDays( $this->unlock_days );
                }
                $now = Carbon::now();

                if ($unlock_date->gt($now)){
                    $dripContentIds[] = $dripContent->id;
                }
            }
        }

        $dripItems['sections'] = array_unique($dripSectionIds);
        $dripItems['contents'] = array_unique($dripContentIds);

        return $dripItems;
    }

}
