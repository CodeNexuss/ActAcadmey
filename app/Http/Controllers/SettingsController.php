<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;


class SettingsController extends Controller
{


    public function GeneralSettings(){
        $title = trans('admin.general_settings');
        return view('admin.settings.general_settings', compact('title'));
    }

    public function joinus_links(){
        $title = "Join Us Links";
        return view('admin.settings.joinus_links', compact('title'));
    }

    public function LMSSettings(){
        $title = trans('admin.lms_settings');
        return view('admin.settings.lms_settings', compact('title'));
    }

    public function StorageSettings(){
        $title = trans('admin.file_storage_settings');
        return view('admin.settings.storage_settings', compact('title'));
    }

    public function ThemeSettings(){
        $title = trans('admin.theme_settings');
        return view('admin.settings.theme_settings', compact('title'));
    }
    public function invoiceSettings(){
        $title = trans('admin.invoice_settings');
        return view('admin.settings.invoice_settings', compact('title'));
    }

    public function modernThemeSettings(){
        $title = trans('admin.modern_theme_settings');
        return view('admin.settings.modern_theme_settings', compact('title'));
    }

    public function SocialUrlSettings(){
        $title = trans('admin.social_url_settings');
        return view('admin.settings.social_url_settings', compact('title'));
    }
    public function SocialSettings(){
        $title = __a('social_login_settings');
        return view('admin.settings.social_settings', compact('title'));
    }
    public function BlogSettings(){
        $title = trans('admin.blog_settings');
        return view('admin.settings.blog_settings', compact('title'));
    }

    public function withdraw(){
        $title = trans('admin.withdraw');
        return view('admin.settings.withdraw_settings', compact('title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array|\Illuminate\Http\RedirectResponse
     */

    public function update(Request $request) {
        $inputs = array_except($request->input(), ['_token']);

        foreach($inputs as $key => $value) {
            if (is_array($value)){
                $value = 'json_encode_value_'. json_encode($value);
            }

            $option = Option::firstOrCreate(['option_key' => $key]);
            $option -> option_value = $value;
            $option->save();
        }
        //check is request comes via ajax?
        if ($request->ajax()){
            return ['success'=>1, 'msg'=> __a('settings_saved_msg')];
        }
        return redirect()->back()->with('success', __a('settings_saved_msg'));
    }



}
