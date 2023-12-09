<?php

namespace App\Http\Controllers;

use App\Course;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addToCart(Request $request){
        if ( ! Auth::check()){
            if ($request->ajax()){
                //return ['success' => 0, 'message' => 'unauthenticated'];
            }
            //return route('login');
        }

        $course_id = $request->course_id;
        $course = Course::find($course_id);

        $cartData = (array) session('cart');
        $cartData[$course->id] = [
            'hash'              => str_random(),
            'course_id'         => $course->id,
            'title'             => $course->title,
            'price'             => $course->get_price,
            'original_price'    => $course->price,
            'price_plan'        => $course->price_plan,
            'course_url'        => route('course', $course->slug),
            'thumbnail'      => media_image_uri($course->thumbnail_id)->thumbnail,
            'price_html'      => $course->price_html(false),
        ];
        session(['cart' => $cartData]);

        if ($request->ajax()){
            return ['success' => 1, 'cart_html' => view_template_part('template-part.minicart') ];
        }

        if ($request->cart_btn === 'buy_now'){
            return redirect(route('checkout'));
        }
    }

    /**
     * @param Request $request
     * @return array
     *
     * Remove From Cart
     */
    public function removeCart(Request $request){
        $cartData = (array) session('cart');
        if (array_get($cartData, $request->cart_id)){
            unset($cartData[$request->cart_id]);
        }
        session(['cart' => $cartData]);
        return ['success' => 1, 'cart_html' => view_template_part('template-part.minicart') ];
    }

    public function checkout(){
        $title = __t('checkout');
        return view(theme('checkout'), compact('title'));
    }





}
