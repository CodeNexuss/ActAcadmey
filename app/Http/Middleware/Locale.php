<?php

namespace App\Http\Middleware;

use Closure;
use DB;
use Session;
use App;
use App\Language;
use App\Option;
use View;
use Request;
use Auth;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = Language::where('default_language', '=', '1')->first()->value;
        $session_language = Language::where('value', '=', Session::get('language'))->first();
        // dd($session_language);
        
        if($request->language) {
          $locale = $request->language;
          // echo 'if - '.$locale;
        }else if($session_language) {
          $locale = $session_language->value;
          // echo 'else if - '.$locale;
        }
        // exit;

        App::setLocale($locale);
        Session::put('language', $locale);

        $options = Option::all()->pluck('option_value', 'option_key')->toArray();
        $configs = [];
        $configs['options'] = $options;

        $configs['options']['allowed_file_types_arr'] = array_filter(explode(',', array_get($options, 'allowed_file_types')));
        
        $configs['lang_str'] = [];
        $theme_slug = array_get($options, 'current_theme');
        
        $language_path = public_path("themes/bluetheme/languages/{$locale}.php");
        if (file_exists($language_path)) {
            $configs['lang_str'] = include_once $language_path;
        }

        $configs['app.timezone'] = array_get($options, 'default_timezone');
        $configs['app.url'] = array_get($options, 'site_url');
        $configs['app.name'] = array_get($options, 'site_title');

        $configs = apply_filters('app_configs', $configs);
        config($configs);
        
        return $next($request);
    }
}
