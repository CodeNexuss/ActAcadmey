<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Lang;
use App;
use Session;
use App\User;
use App\Language;

class LanguageController extends Controller
{
    public function index(Request $request){

        $languages = Language::query();

        $title = __a('manage_language');
        $languages = $languages->orderBy('id', 'asc')->paginate(100);

        return view('admin.settings.manage_language', compact('title', 'languages'));
    }

    public function add() {

        $data['title'] = __a('add_language');
        return view('admin.settings.language_add', $data);
    }

    public function store(Request $request)
    {
        if($request->isMethod('GET')) {
            return redirect(route('language_settings'));
        }

        if(is_live_env()) return back()->with('error', __a('demo_restriction'));

        $rules = [
            'name' => 'required|unique:languages,name,'.$request->name,
            'value' => 'required|unique:languages,value,'.$request->value,
        ];
        $this->validate($request, $rules);

        $data = [
            'name'              => clean_html($request->name),
            'value'             => clean_html($request->value),
            'status'            => $request->status,
            'default_language'  => $request->default_language,
        ];

        Language::create($data);
        $admin_path = base_path().'/resources/lang/'.$data['value'];
        $en_admin = base_path().'/resources/lang/en/admin.php';
        if(!File::exists($admin_path)) {
            $result = File::makeDirectory($admin_path,0777);
            File::copy($en_admin, $admin_path.'/admin.php');
        }
        $path = "themes/bluetheme/languages/".$data['value'].".php";
        $frontend_path = public_path($path);
        if(!File::exists($frontend_path)) {
            // $content = "<?php\n\nreturn\n[\n";
            // $content .= "];";
            $content = file_get_contents(public_path('themes/bluetheme/languages/en.php'));
            file_put_contents($frontend_path, $content);
            chmod($frontend_path, 0777);
        }

        return redirect(route('language_settings'))->with('success', __a('lang_created_success'));
    }

    public function edit($id) {

        $data['title'] = __a('edit_language');
        $data['language'] = Language::find($id);

        if ( ! $data['language']){
            abort(404);
        }
        return view('admin.settings.language_edit', $data);
    }

    public function update(Request $request, $id) {
        if(is_live_env()) return back()->with('error', __a('demo_restriction'));

        $language = Language::find($id);
        if ( ! $language){
            return back()->with('error', __a('lang_not_found'));
        }

        $rules = [
            'name' => 'required|unique:languages,name,'.$id,
            'value' => 'required|unique:languages,value,'.$id,
        ];
        $this->validate($request, $rules);

        $data = [
            'name'              => clean_html($request->name),
            'value'             => clean_html($request->value),
            'status'            => $request->status,
            'default_language'  => $request->default_language
        ];
        if($data['status']!=1 && $data['default_language']==1) {
            return back()->with('error', 'Default language should not be Inactive');
        }
        $default_language = Language::where('default_language', 1)->first();
        if($default_language->id == $id) {
            if($data['default_language']==0) {
                return back()->with('error', 'Atleast one language must be set as default');
            }
        }
        $language->update($data);
        Session::put('language', $data['value']);
        App::setLocale($data['value']);
        // echo app()->getLocale(); exit;

        if($data['default_language']==1) {
            Language::where('id', '!=', $id)->update(['default_language' => 0]);
        }

        return redirect(route('language_settings'))->with('success', __a('lang_updated_success'));
    }

    public function language_bulk_status_update(Request $request) {
        if(is_live_env()) return back()->with('error', __a('demo_restriction'));

        if (count($request->languages)){
            Language::whereIn('id', $request->languages)->update(['status'=>$request->status]);
            return ['success' => true];
        }
        return ['success' => false];
    }

    public function destroy(Request $request)
    {
        if(is_live_env()) return back()->with('error', __a('demo_restriction'));

        if (count($request->languages)){
            foreach($request->languages as $id) {
                $lang = Language::find($id);

                $admin_path = base_path().'/resources/lang/'.$lang->value;
                if(File::exists($admin_path)) {
                    $result = File::deleteDirectory($admin_path);
                }
                $path = "themes/bluetheme/languages/".$lang->value.".php";
                $frontend_path = public_path($path);
                if(File::exists($frontend_path)) {
                    $result = File::delete($frontend_path);
                }
                $lang->delete();
            }
            // Language::whereIn('id', $request->languages)->delete();
            return ['success' => true];
        }
        return ['success' => false];
    }

    public function manage_web_language(Request $request) {
        $data['all_language'] = Language::active()->pluck('name','value');

        foreach ($data['all_language'] as  $key => $value) {
            $data['lang_data'][$key] = $this->get_lang_data($key, 'admin');
        }
        $data['file'] = 'admin';
        // $data['file'] = 'web_language';
        // dd($data);

        return view('admin.settings.manage_web_language', $data);

    }

    public function manage_web_front_language(Request $request) {
        $data['all_language'] = Language::active()->pluck('name','value');

        foreach ($data['all_language'] as  $key => $value) {
            $data['lang_data'][$key] = $this->get_lang_data_for_frontend($key, 'admin');
        }
        $data['file'] = 'frontend';
        // $data['file'] = 'web_language';
        // dd($data);

        return view('admin.settings.manage_web_language', $data);

    }

    public function manage_web_validation_msg(Request $request) {
        $data['all_language'] = Language::active()->pluck('name','value');

        foreach ($data['all_language'] as  $key => $value) {
            $data['lang_data'][$key] = $this->get_lang_data($key, 'validation');
        }
        $data['file'] = 'validation';
        // dd($data);

        return view('admin.settings.manage_web_language', $data);

    }

    private function get_lang_data_for_frontend($lang='en', $file='admin') {
        // $arrayLang = Lang::get($file,[],$lang);
        $path = "themes/bluetheme/languages/".$lang.".php";
        $language_path = public_path($path);
        include $language_path;
        $arrayLang = require $language_path;

        if (gettype($arrayLang) == 'string') 
            $arrayLang = array();

        //if some data not in array it's store in other array 
        $other = $arrayLang; 
        foreach ($other as $key => $value)
        { 
            if (is_array($value))
                unset($other[$key]);
            else
                unset($arrayLang[$key]);
        } 

        if(count($other))
            $arrayLang['other'] = $other;
        //  dd(  $arrayLang['other'] );
        return $arrayLang;
    }

    private function get_lang_data($lang='en', $file='admin') {
        $arrayLang = Lang::get($file,[],$lang);

        if (gettype($arrayLang) == 'string') 
            $arrayLang = array();

        //if some data not in array it's store in other array 
        $other = $arrayLang; 
        foreach ($other as $key => $value)
        { 
            if (is_array($value))
                unset($other[$key]);
            else
                unset($arrayLang[$key]);
        } 

        if(count($other))
            $arrayLang['other'] = $other;
        //  dd(  $arrayLang['other'] );
        return $arrayLang;
    }

}
