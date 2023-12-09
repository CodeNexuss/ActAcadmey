<?php
namespace App\Plugins\Certificate;

use App\Module\PluginBase;
use Illuminate\Support\Facades\Auth;

class CertificatePlugin extends PluginBase {

    public $name = 'Certificate';
    public $slug = 'certificate';

    public function boot(){
        $this->enableRoutes();
        $this->enableViews();

        add_action('lecture_single_after_progressbar', [$this, 'download_certificate_btn']);
        add_action('admin_menu_item_after', [$this, 'add_admin_menu_certificate']);

    }

    public function download_certificate_btn($course){

        if (Auth::check()){
            $user = Auth::user();

            $isCourseComplete = $user->is_completed_course($course->id);
            // dd($isCourseComplete, $course->completed_percent());
            if ($isCourseComplete && $user->is_evaluated_course($course->id) && $course->completed_percent()==100){
                $certURL = route('download_certificate', $course->id);

                echo "<div class='mb-0 text-center'> <a href='{$certURL}' class='btn cls_dark_btn'> <i class='la la-long-arrow-right'></i> ".__t('download_certificate')."</a> </div>";
            }

        }

    }


    public function add_admin_menu_certificate(){
        $settingsURL = route('certificate_settings');

        echo "<li> <a href='{$settingsURL}'><i class='la la-long-arrow-right'></i> Certificate Settings</a>  </li>";
    }


}
