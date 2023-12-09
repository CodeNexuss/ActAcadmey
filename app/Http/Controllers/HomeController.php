<?php

namespace App\Http\Controllers;

use App;
use App\Category;
use App\Course;
use App\Post;
use App\HomepageSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use DB;
use Auth;

class HomeController extends Controller
{
    public function index(){
        $data = [];
        $data['title']              = __t('home_page_title');
        $data['new_courses']        = Course::publish()->authorExist()->orderBy('created_at', 'desc')->take(10)->get();

        $data['featured_courses']   = Course::publish()->authorExist()->whereIsFeatured(1)->orderBy('featured_at', 'desc')->take(10)->get();

        $data['popular_courses']    = Course::publish()->authorExist()->whereIsPopular(1)->orderBy('popular_added_at', 'desc')->take(10)->get();

        if(Auth::user()) {
            $data['user'] = Auth::user();
            // dd($data['user']->original_last_viewed_course, $data['user']->related_for_last_viewed_course);
        }
        $data['most_viewed']        = Course::publish()->authorExist()->orderBy('view_count', 'desc')->take(10)->get();
        if(Auth::user()) {

            $rand_course = (auth()->user()->enrolls != null && !auth()->user()->enrolls->isEmpty()) ? auth()->user()->enrolls->random() : '';
            // dd($rand_course);
            $random_category_id = ($rand_course!='') ? $rand_course->parent_category_id : '';
            if($random_category_id!='') {
                $data['random_enrolled'] = $rand_course;
                $data['related_for_enrolled'] = Course::publish()->authorExist()->where('parent_category_id', $random_category_id)->orderBy('created_at', 'desc')->take(10)->get();
            } else {
                $data['random_enrolled'] = '';
                $data['related_for_enrolled'] = collect([]);    
            }
        } else {
            $data['random_enrolled'] = '';
            $data['related_for_enrolled'] = collect([]);
        }

        $data['posts']              = Post::post()->publish()->take(3)->get();
        $data['home_slider']        = HomepageSlider::where('status', 1)->orderBy('order', 'asc')->get();

        $data['top_categories']     = Category::parent()->whereStatus(1)->whereIsTop(1)->get();

        $data['top_topics']         = Category::with('category_courses')->whereStep(2)->whereStatus(1)
        ->whereIsTop(1)->orderBy('updated_at', 'desc')->get()
        ->map(function($category) {
            $category->setRelation('category_courses', $category->category_courses->where('is_top', 1)->take(10));
            return $category;
        });
        // dd($data['top_topics']);

        return view(theme('index'), $data);
    }

    public function courses(Request $r){
        $data['title'] = __t('courses');
        $data['categories'] = Category::parent()->with('sub_categories')->get();
        $data['sub_categories'] = Category::whereCategoryId($r->parent_category)->get();
        $data['topics'] = Category::whereCategoryId($r->category)->get();
        $data['sort'] = ($r->sort) ? $r->sort : '';
        $data['request'] = $r->all();
        $data['category'] = $r->category;
        $data['topic'] = $r->topic;
        if(Auth::user()) {
            $data['user'] = Auth::user();
        }

        $courses = Course::query();
        $courses = $courses->publish()->authorExist();

        if ($r->path() === 'featured-courses'){
            $title = __t('featured_courses');
            $courses = $courses->where('is_featured', 1);
        }elseif ($r->path() === 'popular-courses'){
            $title = __t('popular_courses');
            $courses = $courses->where('is_popular', 1);
        }

        if ($r->q){
            $courses = $courses->where('title', 'LIKE', "%{$r->q}%");
        }
        if ($r->parent_category){
            if($r->sort!='because_you_viewed' && $r->sort!='you_might_also_like') {
                $courses = $courses->where('parent_category_id', $r->parent_category);
            }
        } else if ($r->category){
            if($r->sort!='because_you_viewed' && $r->sort!='you_might_also_like') {
                $courses = $courses->where('second_category_id', $r->category);
            }
        }
        // if ($r->topic){
            if($r->sort=='you_might_also_like') {
                if(isset($data['user']) && $data['user']->last_wished_course!=NULL) {
                    if($r->topic!='' && $data['user']->last_wished_course->category_id == $r->topic) {
                        $courses = $courses->where('category_id', $data['user']->last_wished_course->category_id)->where('id', '!=', $data['user']->last_wished_course->id);
                        $data['category'] = $r->category = $data['user']->last_wished_course->second_category_id;
                        $data['topic'] = $r->topic = $data['user']->last_wished_course->category_id;
                        
                    } else if($r->topic=='') {
                        $courses = $courses->where('category_id', $data['user']->last_wished_course->category_id)->where('id', '!=', $data['user']->last_wished_course->id);
                        $data['category'] = $r->category = $data['user']->last_wished_course->second_category_id;
                        $data['topic'] = $r->topic = $data['user']->last_wished_course->category_id;
                    } else {
                        $courses = $courses->where('category_id', NULL);
                    }
                    $data['sub_categories'] = Category::whereCategoryId($data['user']->last_wished_course->parent_category_id)->get();
                    $data['topics'] = Category::whereCategoryId($data['user']->last_wished_course->second_category_id)->get();
                } else if(isset($data['user']) && $data['user']->last_wished_course==NULL) {
                    $courses = $courses->where('category_id', NULL);
                }
            } else if($r->sort=='because_you_viewed') {
                if(isset($data['user']) && $data['user']->last_viewed_course!=NULL) {
                    if($r->topic!='' && $data['user']->last_viewed_course->category_id == $r->topic) {
                        $courses = $courses->where('category_id', $data['user']->last_viewed_course->category_id)->where('id', '!=', $data['user']->last_viewed_course->id);
                        $data['category'] = $r->category = $data['user']->last_viewed_course->second_category_id;
                        $data['topic'] = $r->topic = $data['user']->last_viewed_course->category_id;
                        
                    } else if($r->topic=='') {
                        $courses = $courses->where('category_id', $data['user']->last_viewed_course->category_id)->where('id', '!=', $data['user']->last_viewed_course->id);
                        $data['category'] = $r->category = $data['user']->last_viewed_course->second_category_id;
                        $data['topic'] = $r->topic = $data['user']->last_viewed_course->category_id;
                    } else {
                        $courses = $courses->where('category_id', NULL);
                    }
                    $data['sub_categories'] = Category::whereCategoryId($data['user']->last_viewed_course->parent_category_id)->get();
                    $data['topics'] = Category::whereCategoryId($data['user']->last_viewed_course->second_category_id)->get();
                } else if(isset($data['user']) && $data['user']->last_viewed_course==NULL) {
                    $courses = $courses->where('category_id', NULL);
                }
            } else {
                if($r->topic) {
                    $courses = $courses->where('category_id', $r->topic);
                }
            }
        // }
        if ($r->level && ! in_array(0, $r->level)){
            $courses = $courses->whereIn('level', $r->level);
        }
        if ($r->price){
            $courses = $courses->whereIn('price_plan', $r->price);
        }
        if ($r->rating){
            $courses = $courses->where('rating_value','>=', $r->rating);
        }


        /**
         * Find by Video Duration
         */
        if ($r->video_duration === '0_2'){
            $durationEnd = (60 * 60 * 3) - 1; //02:59:59
            $courses = $courses->where('total_video_time','<=', $durationEnd);
        }elseif ($r->video_duration === '3_5'){
            $durationStart = (60 * 60 * 3) ;
            $durationEnd = (60 * 60 * 6) -1;
            $courses = $courses->whereBetween('total_video_time',[$durationStart, $durationEnd]);
        }elseif ($r->video_duration === '6_10'){
            $durationStart = (60 * 60 * 6) ;
            $durationEnd = (60 * 60 * 11) -1;
            $courses = $courses->whereBetween('total_video_time',[$durationStart, $durationEnd]);
        }elseif ($r->video_duration === '11_20'){
            $durationStart = (60 * 60 * 11) ;
            $durationEnd = (60 * 60 * 21) -1;
            $courses = $courses->whereBetween('total_video_time',[$durationStart, $durationEnd]);
        }elseif ($r->video_duration === '21'){
            $durationStart = (60 * 60 * 21) ;
            $courses = $courses->where('total_video_time', '>=', $durationStart);
        }

        switch ($r->sort){
            case 'most-reviewed' :
                $courses = $courses->orderBy('rating_count', 'desc');
                break;
            case 'highest-rated' :
                $courses = $courses->orderBy('rating_value', 'desc');
                break;
            case 'newest' :
                $courses = $courses->orderBy('published_at', 'desc');
                break;
            case 'price-low-to-high' :
                $courses = $courses->orderBy('price', 'asc');
                break;
            case 'price-high-to-low' :
                $courses = $courses->orderBy('price', 'desc');
                break;
            case 'featured_courses' :
                $courses = $courses->whereIsFeatured(1)->orderBy('featured_at', 'desc');
                break;
            case 'popular_courses' :
                $courses = $courses->whereIsPopular(1)->orderBy('popular_added_at', 'desc');
                break;
            case 'new_courses' :
                $courses = $courses->orderBy('created_at', 'desc');
                break;
            case 'most_viewed' :
                $courses = $courses->orderBy('view_count', 'desc');
                break;
            default:

                if ($r->path() === 'featured-courses'){
                    $courses = $courses->orderBy('featured_at', 'desc');
                }elseif ($r->path() === 'popular-courses'){
                    $courses = $courses->orderBy('popular_added_at', 'desc');
                }
                else{
                    $courses = $courses->orderBy('created_at', 'desc');
                }
        }

        $per_page = $r->perpage ? $r->perpage : 10;
        $appends = $r->all();
        // dd($courses->toSql());
        $data['courses'] = $courses->paginate($per_page)->appends($appends);

        return view(theme('courses'), $data);
    }

    public function change_language(Request $request)
    {
        // echo "<pre>"; print_r($request->all()); exit;
        if ($request->language) {
            session(['language' => $request->language]);
            App::setLocale($request->language);
            // echo session()->get('language'); exit;
        }
    }

    public function clearCache(){
        Artisan::call('debugbar:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('optimize:clear');
        if (function_exists('exec')){
            exec('rm ' . storage_path('logs/*'));
        }
        $this->rrmdir(storage_path('logs/'));

        return redirect(route('home'));
    }

    public function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (is_dir($dir."/".$object))
                        $this->rrmdir($dir."/".$object);
                    else
                        unlink($dir."/".$object);
                }
            }
            //rmdir($dir);
        }
    }

    public function updateEnv(Request $request)
    {
        $requests = $request->all();
        $valid_env = ['APP_ENV','APP_DEBUG','Live_Chat'];
        foreach ($requests as $key => $value) {
            $prev_value = getenv($key);
            logger($key.' - '.$prev_value);
            if(in_array($key,$valid_env)) {
                updateEnvConfig($key,$value);
            }
        }
    }

}
