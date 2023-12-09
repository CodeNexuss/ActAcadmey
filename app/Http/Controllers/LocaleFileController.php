<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use App;
use Lang;

class LocaleFileController extends Controller
{
    private $lang = '';
    private $file;
    private $path;
    private $arrayLang = array();

    //------------------------------------------------------------------------------
    // Read lang file content
    //------------------------------------------------------------------------------

    private function read($view=false) 
    {
        if ($this->lang == '') $this->lang = App::getLocale();
        if($this->file=='frontend') {
            $path = "themes/bluetheme/languages/".$this->lang.".php";
            $language_path = public_path($path);
            include $language_path;
            $this->arrayLang = require $language_path;
        } else {
            $this->arrayLang = Lang::get(str_replace('.php','',$this->file),[],$this->lang);
        }
        if (gettype($this->arrayLang) == 'string') $this->arrayLang = array();
        
        // replace site name 
        if($view){
            if(isset($this->arrayLang['common']))
                $this->arrayLang['common']['app_name'] = site_settings('site_name');
                //$this->arrayLang['common']['goferhandy_service_provider_app'] = site_settings('site_name');
        }
        //if some data not in array it's store in other array 
        $other = $this->arrayLang; 
        foreach ($other as $key => $value) { 
            if (is_array($value))
                unset($other[$key]);
            else
                unset($this->arrayLang[$key]);
        } 
        if(count($other))
        $this->arrayLang['other'] = $other;
    }

    private function get_lang_data($lang='en',$file='messages') 
    {
        $arrayLang = Lang::get($file,[],$lang);
        if (gettype($arrayLang) == 'string') 
            $arrayLang = array();

        //if some data not in array it's store in other array 
        $other = $arrayLang; 
        foreach ($other as $key => $value) { 
            if (is_array($value))
                unset($other[$key]);
            else
                unset($arrayLang[$key]);
        } 
        if(count($other))
        $arrayLang['other'] = $other;
        return $arrayLang;
    }

    //------------------------------------------------------------------------------
    // Save lang file content
    //------------------------------------------------------------------------------

    private function save() 
    {
        if($this->file=='frontend') {
            $path = "themes/bluetheme/languages/".$this->lang.".php";
            $path = public_path($path);
        } else {
            $path = base_path().'/resources/lang/'.$this->lang.'/'.$this->file;
        }
        $content = "<?php\n\nreturn\n[\n";

        foreach ($this->arrayLang as $key => $value) 
        {
            if(is_array($value))
            {
                //save other array ti individual 
                if($key!='other')
                    $content .= "\t'".$key."'=>[\n"; 
                foreach ($value as $sub_key => $sub_value) {
                    $content .= "\t'".$sub_key."' => '".str_replace("'", "\'", $sub_value)."',\n";
                }
                if($key!='other')
                    $content .= "],\n";
            }else{

                $content .= "\t'".$key."' => '".str_replace("'", "\'", $value)."',\n";
            }
        }
        $content .= "];";

        file_put_contents($path, $content);
    }



    public function get_language_data($lang='en',$file='messages.php',$view=false) 
    {
        // Process and prepare you data as you like.
        $this->lang = $lang;
        $this->file = $file;
        // END - Process and prepare your data
        $this->read($view);
        return $this->arrayLang;
    }

    public function get_locale(Request $request) 
    {
        // Process and prepare you data as you like.
        $this->lang = $request->lang ?? 'en';
        $this->file = 'messages.php';
        // END - Process and prepare your data
        $this->read();
        $language = $this->arrayLang;
        $select_lang = $this->lang;
        $all_language = Language::active()->pluck('name','value');

        return view('admin.language.change_language',compact('language','all_language','select_lang'));
    }

  

    public function update_locale(Request $request) 
    {
        // Process and prepare you data as you like.
        $this->lang = $request->language ?? 'en';
        $this->file = 'messages.php';
        $this->arrayLang = $request->data;
        // END - Process and prepare your data
        $this->save();
        $helper = new App\Http\Start\Helpers;
        $helper->flash_message('success', 'Language update Successfully');
        return redirect()->route('language.locale',['lang'=>$this->lang]);
    }



    public function getLang(Request $request) 
    {
        // Process and prepare you data as you like.
        $this->lang = $request->lang ?? 'en';
        $this->file = 'messages.php';
        // END - Process and prepare your data
        $language = $this->arrayLang;
        $select_lang = $this->lang;
        $all_language = Language::active()->pluck('name','value');
        foreach ($all_language as  $key => $value) {
            $lang_data[$key] = $this->get_lang_data($key);
        }
        
        return view('admin/language/api_language',compact('lang_data','all_language','select_lang'));
    }

    //update content in lanaguage file 
    public function update_language(Request $request) 
    {
        $this->lang = $request->language ?? 'en';
        $this->file = $this->get_file($request->file);

        $this->read();
        $this->arrayLang[$request->main_key][$request->sub_key] = $request->messages;
        $this->save();
        // \Artisan::call('lang:js');  
        return response()->json(['success' => true]);
    }

    public function get_file($file='')
    {
        if($file=='web_language')
            return 'messages.php';
        elseif($file=='mobile_language_user')
            return 'user_api_languages.php';
        elseif ($file=='mobile_language_provider') 
            return 'provider_api_languages.php';
        elseif ($file=='mobile_language_store') 
            return 'store_api_language.php';
        elseif ($file=='validation_message') 
            return 'js_messages.php';
        elseif($file=='admin')
            return 'admin.php';
        elseif($file=='validation')
            return 'validation.php';
        elseif($file=='frontend')
            return 'frontend';
        else
            return 'messages.php';

    }
}
