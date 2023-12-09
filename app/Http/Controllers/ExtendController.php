<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Finder\Finder;

class ExtendController extends Controller
{

    public function plugins(){
        $title = __a('plugins');
        $plugins = app('Udify')->getPlugins();
        $plugins = collect($plugins)->except(['live_class', 'multi_instructor'])->toArray();
        $extended_products = (array) $this->extended_products();
        $extended_plugins = array_get($extended_products, 'plugin');

        return view('extend.plugins', compact('title', 'plugins', 'extended_plugins'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Activate or deactivate plugin
     */
    public function pluginAction(Request $request){
        $action = $request->action;
        $plugin = $request->plugin;

        if ($action === 'activate'){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));
            $active_plugins = (array) json_decode(get_option('active_plugins'), true);
            $active_plugins[] = $plugin;

            update_option('active_plugins', array_unique($active_plugins));
            return back()->with('success', __a('plugin_activated'));
        }

        if ($action === 'deactivate'){
            if(is_live_env()) return back()->with('error', __a('demo_restriction'));
            $active_plugins = (array) json_decode(get_option('active_plugins'), true);
            update_option('active_plugins', array_unique(array_diff($active_plugins, [$plugin])));
            return redirect(route('plugins'))->with('success', __a('plugin_deactivated'));
        }
    }

    public function findPlugins(){
        $title = __a('find_plugins');
        $extended_products = (array) $this->extended_products();
        $extended_plugins = array_get($extended_products, 'plugin');

        return view('extend.find_plugins', compact('title', 'extended_plugins'));
    }

    public function themes(){
        $title = __a('themes');

        $current_theme = get_option('current_theme');
        $installed_themes = [];
        foreach (Finder::create()->in(ROOT_PATH.'/themes')->directories()->depth(0) as $dir) {
            $directoryName = $dir->getBasename();
            $themePath = $dir->getPathname();

            $theme_info = include_once $themePath.'/ThemeInfo.php';

            $screenshot_url = asset('images/placeholder-image.png');
            if (file_exists($themePath."/screenshot.png")){
                $screenshot_url = asset("themes/{$directoryName}/screenshot.png");
            }elseif(file_exists($themePath."/screenshot.jpg")){
                $screenshot_url = asset("themes/{$directoryName}/screenshot.jpg");
            }

            $theme_info['screenshot_url'] = $screenshot_url;

            $installed_themes[$directoryName] = $theme_info;
        }
        $installed_themes = array_merge([$current_theme => array_get($installed_themes, $current_theme)], $installed_themes );

        return view('extend.themes', compact('title', 'installed_themes'));
    }

    public function activateTheme(Request $request){
        $theme = $request->theme_slug;
        update_option('current_theme', $theme);
        return back()->with('success', __a('theme_activated'));
    }

    public function findThemes(){
        $title = __a('find_themes');
        $extended_products = (array) $this->extended_products();
        $themes = array_get($extended_products, 'theme');

        return view('extend.find_themes', compact('title', 'themes'));
    }

    public function extended_products(){


        return true;
    }


}
