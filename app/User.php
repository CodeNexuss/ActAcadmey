<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [ 'original_last_wished_course', 'last_wished_course', 'also_liked_courses', 'original_last_viewed_course', 'last_viewed_course', 'related_for_last_viewed_course' ];


    // JWT Auth Functions Start
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    // JWT Auth Functions End


    public function scopeActive($query){
        return $query->where('active_status', 1)->with('photo_query');
    }
    public function scopeInstructor($query){
        return $query->where('user_type', 'instructor');
    }


    public function medias(){
        return $this->hasMany(Media::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class)->orderBy('created_at', 'desc');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function get_reviews(){
        return $this->belongsToMany(Review::class, 'course_user', 'user_id', 'course_id', 'id', 'course_id');
    }

    public function instructor_discussions(){
        return $this->belongsToMany(Discussion::class, 'course_user', 'user_id', 'course_id', 'id', 'course_id')->with('user', 'user.photo_query')->where('discussion_id', 0);
    }
    public function wishlist(){
        return $this->belongsToMany(Course::class, 'wishlists');
    }

    public function earnings(){
        return $this->hasMany(Earning::class, 'instructor_id')->where('payment_status', 'success');
    }

    public function withdraws(){
        return $this->hasMany(Withdraw::class)->orderBy('created_at', 'desc');
    }

    public function purchases(){
        return $this->hasMany(Payment::class)->orderBy('created_at', 'desc');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function my_quiz_attempts(){
        return $this->hasMany(Attempt::class);
    }

    public function getGetRatingAttribute(){
        $sql = "select count(reviews.id) as rating_count,
avg(reviews.rating) as rating_avg
from reviews
inner join course_user on reviews.course_id = course_user.course_id
where course_user.user_id = {$this->id} and reviews.status = 1";

        $rating = DB::selectOne(DB::raw($sql));
        $rating->rating_avg = number_format($rating->rating_avg, 2);
        return $rating;
    }

    public function isAdmin(){
        return $this->user_type === 'admin';
    }

    public function getIsAdminAttribute(){
        return $this->isAdmin();
    }

    public function isInstructor(){
        return $this->user_type === 'instructor' || $this->isAdmin();
    }

    public function isStudent(){
        return $this->user_type === 'student';
    }
    public function getIsInstructorAttribute(){
        return $this->isInstructor();
    }

    public function photo_query(){
        return $this->belongsTo(Media::class, 'photo');
    }

    public function getGetPhotoAttribute(){
        if ($this->photo){
            $url = media_image_uri($this->photo_query)->thumbnail;
            return "<img src='{$url}' class='profile-photo' alt='{$this->name}' /> ";
        }

        $arr = explode(' ', trim($this->name));

        if (count($arr) > 1){
            $first_char = substr($arr[0], 0, 1) ;
            $second_char = substr($arr[1], 0, 1) ;
        }else{
            $first_char = substr($arr[0], 0, 1) ;
            $second_char = substr($arr[0], 1, 1) ;
        }

        $textPhoto = strtoupper($first_char.$second_char);

        $bg_color = '#'.substr(md5($textPhoto), 0, 6);
        $textPhoto = "<span class='profile-text-photo' style='background-color: {$bg_color}; color: #fff8e5'>{$textPhoto}</span>";

        return $textPhoto;
    }


    public function enrolls(){
        return $this->belongsToMany(Course::class, 'enrolls')->authorExist()->wherePivot('status', '=', 'success');
    }

    public function isEnrolled($course_id = 0){
        if ($course_id === 0){
            return false;
        }

        $isEnrolled = DB::table('enrolls')->whereUserId($this->id)->whereCourseId($course_id)->whereStatus('success')->orderBy('enrolled_at', 'desc')->first();

        return $isEnrolled;
    }


    public function isInstructorInCourse($course_id){
        return $this->courses()->whereCourseId($course_id)->first();
    }

    /**
     * @param null $course_id
     * @return bool
     *
     * Complete Course
     */
    public function complete_course($course_id = null){
        if ( ! $course_id){
            return false;
        }

        $is_completed = Complete::whereCompletedCourseId($course_id)->whereUserId($this->id)->first();

        if ($is_completed){
            return $is_completed;
        }
        $data = [
            'user_id'               => $this->id,
            'completed_course_id'   => $course_id,
            'course_id'             => $course_id,
            'completed_at'          => Carbon::now()->toDateTimeString(),
        ];
        return Complete::create($data);
    }

    public function is_completed_course($course_id){
        $is_completed = Complete::whereCompletedCourseId($course_id)->whereUserId($this->id)->first();
        return $is_completed;
    }

    public function is_evaluated_course($course_id) {
        $assignment = AssignmentSubmission::where(['user_id'=>$this->id, 'course_id'=>$course_id])->where('is_evaluated', '!=', 1)->first();
        return !$assignment;
    }

    public function get_option($key = null, $default = null){
        if ($this->options){
            $options = (array) json_decode($this->options, true);
            $value = get_from_array($key, $options);

            if ($value){
                return $value;
            }
        }
        return $default;
    }

    public function update_option($key = null, $value = ''){
        if ($key){
            $options = (array) json_decode($this->options, true);
            $options[$key] = $value;
            $this->update(['options' => $options]);
        }
    }

    public function student_enrolls(){
        return $this->belongsToMany(Enroll::class, 'course_user', 'user_id', 'course_id', 'id', 'course_id')->whereStatus('success');
    }

    public function enroll_sync(){
        $enrolledCourse = (array) $this->enrolls()->pluck('course_id')->all();
        $enrolledCourse =  array_unique($enrolledCourse);
        $this->update_option('enrolled_courses', $enrolledCourse);

        return $this;
    }

    /**
     * Earning Related
     */

    public function getEarningAttribute(){
        $sales_amount = $this->earnings->sum('amount');

        $earnings = $this->earnings->sum('instructor_amount');
        $commission = $this->earnings->sum('admin_amount');

        $withdraws_sum = $this->withdraws->where('status', '!=', 'rejected')->sum('amount');
        $withdraws_total = $this->withdraws->where('status', 'approved')->sum('amount');

        $balance = $earnings - $withdraws_sum;

        $data = [
            'sales_amount'  => $sales_amount,
            'commission'  => $commission,
            'earnings'  => $earnings,
            'balance'  => $balance,
            'withdrawals'  => $withdraws_total,
        ];

        return (object) $data;
    }


    function getWithdrawMethodAttribute(){
        $method = $this->get_option('withdraw_preference');
        $method_key = array_get($method, 'method');

        if ( ! array_get($method, 'method')){
            return null;
        }

        $saved_method = active_withdraw_methods($method_key);
        $saved_method['method_key'] = $method_key;
        $form_fields = array_get($saved_method, 'form_fields');

        if (is_array($form_fields) && count($form_fields)){
            foreach ($form_fields as $form_key => $form_value){
                $form_value['value'] = array_get($method, $method_key.'.'.$form_key );
                $form_fields[$form_key] = $form_value;
            }
        }

        $saved_method['form_fields'] = $form_fields;
        $saved_method['admin_form_fields'] = get_option("withdraw_methods.{$method_key}");

        return (object) $saved_method;
    }

    public function get_attempt($quiz_id){
        $attempt = Attempt::where('user_id', $this->id)->where('quiz_id', $quiz_id)->first();
        return $attempt;
    }

    public function getLastWishedCourseAttribute() {
        $course = Course::find($this->attributes['last_wished_course']);
        return $course;
    }

    public function getOriginalLastWishedCourseAttribute() {
        return $this->attributes['last_wished_course'];
    }

    public function getAlsoLikedCoursesAttribute() {
        $course = Course::find($this->attributes['last_wished_course']);
        if(!$course) {
            return [];
        }
        $liked_courses = Course::authorExist()->where(['category_id'=>$course->category_id, 'status'=>1])->where('id', '!=', $course->id)->take(10)->get();
        return $liked_courses;
    }

    public function getLastViewedCourseAttribute() {
        $course = Course::find($this->attributes['last_viewed_course']);
        return $course;
    }

    public function getOriginalLastViewedCourseAttribute() {
        return $this->attributes['last_viewed_course'];
    }

    public function getRelatedForLastViewedCourseAttribute() {
        $course = Course::find($this->attributes['last_viewed_course']);
        if(!$course) {
            return [];
        }
        $last_viewed_course = Course::authorExist()->where(['category_id'=>$course->category_id, 'status'=>1])->where('id', '!=', $course->id)->take(10)->get();
        return $last_viewed_course;
    }

}
