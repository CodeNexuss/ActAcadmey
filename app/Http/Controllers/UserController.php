<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;
use App\Course;
use App\Enroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile($id){
        $user =  User::find($id);
        if ( ! $user){
            abort(404);
        }

        $title = $user->name;
        return view(theme('profile'), compact('user', 'title'));
    }

    public function review($id){
        $review = Review::find($id);
        $title = 'Review by '. $review->user->name;

        return view(theme('review'), compact('review', 'title'));
    }

    public function updateWishlist(Request $request){
        $course_id = $request->course_id;

        $user = Auth::user();
        if ( ! $user->wishlist->contains($course_id)){
            $user->wishlist()->attach($course_id);
            $response = ['success' => 1, 'state' => 'added'];
        }else{
            $user->wishlist()->detach($course_id);
            $response = ['success' => 1, 'state' => 'removed'];
        }

        $addedWishList = DB::table('wishlists')->where('user_id', $user->id)->pluck('course_id');
        $last_wishlist = DB::table('wishlists')->where('user_id', $user->id)->orderBy('id', 'desc')->take(1)->get();
        if($last_wishlist->count() > 0 && $last_wishlist->first()->course_id) {
            User::where('id', $user->id)->update(['last_wished_course' => $last_wishlist->first()->course_id]);
        }

        $user->update_option('wishlists', $addedWishList);

        return $response;
    }



    public function changePassword(){
        $title = __a('change_password');
        return view('admin.change_password', compact('title'));
    }

    public function changePasswordPost(Request $request){
        if(is_live_env()){
            return redirect()->back()->with('error', __t('demo_restriction'));
        }
        $rules = [
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed',
            'new_password_confirmation'  => 'required',
        ];
        $this->validate($request, $rules);

        $old_password = $request->old_password;
        $new_password = $request->new_password;

        if(Auth::check()) {
            $logged_user = Auth::user();

            if(Hash::check($old_password, $logged_user->password)) {
                $logged_user->password = Hash::make($new_password);
                $logged_user->save();
                return redirect()->back()->with('success', __a('password_changed_msg'));
            }
            return redirect()->back()->with('error', __a('wrong_old_password'));
        }
    }


    public function users(Request $request){
        $ids = (array) $request->bulk_ids;

        if ( is_array($ids) && in_array(1, $ids)){
            return back()->with('error', __a('admin_non_removable'));
        }

        //Update
        if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));
            User::whereIn('id', $ids )->update(['active_status' => $request->status]);
            return back()->with('success', __a('bulk_action_success'));
        }

        if ($request->bulk_action_btn === 'delete' && is_array($ids) && count($ids)){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));

            $courses = Course::whereIn('user_id', $ids)->get();
            if($courses && $courses->count() > 0) {
                return back()->with('error', 'Unable to delete users. Because some of the selected users have courses!');
            }

            $enroll = Enroll::whereIn('user_id', $ids)->get();
            if($enroll && $enroll->count() > 0) {
                return back()->with('error', 'Unable to delete users. Because some of the selected users already enrolled some courses');
            }

            User::whereIn('id', $ids )->delete();
            return back()->with('success', __a('bulk_action_success'));
        }

        $users = User::query();
        if ($request->q){
            $users = $users->where(function($q)use($request) {
                $q->where('name', 'like', "%{$request->q}%")
                    ->orWhere('email', 'like', "%{$request->q}%");
            });
        }

        if ($request->filter_user_group){
            $users = $users->where('user_type', $request->filter_user_group);
        }
        if ($request->filter_status){
            $users = $users->where('active_status', $request->filter_status);
        }


        $title = __a('users');
        $users = $users->orderBy('id', 'desc')->paginate(100);

        return view('admin.users.index', compact('title', 'users'));
    }



}
