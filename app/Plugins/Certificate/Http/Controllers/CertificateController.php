<?php

namespace App\Plugins\Certificate\Http\Controllers;

use App\Course;
use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller{
    private $layouts_path;
    private $layouts_url;
    private $layout;
    private $layout_url;
    private $plugin_url;
    private $debug = false;
    private $user;
    private $course;

    public function __construct(){
        parent::__construct();

        $this->layouts_path = root_path('Plugins/CertificateAssets/layouts/');
        $this->layouts_url = asset("Plugins/CertificateAssets/layouts/");
        $this->plugin_url = asset("Plugins/CertificateAssets");

        $this->layout = 'default';

        $this->debug = true;

        $this->layouts_url = asset("Plugins/CertificateAssets/layouts/".$this->layout);
    }

    public function generateCertificate($course_id){
        if ( ! Auth::check()){
            abort(404);
        }

        $this->user = Auth::user();

        $isCourseComplete = $this->user->is_completed_course($course_id);
        if ( ! $isCourseComplete){
            abort(404);
        }
        $this->course = Course::find($course_id);
        if ( ! $this->course){
            abort(404, 'Course Not Found');
        }

        // include autoloader
        $autoload_url = app_path('Plugins/Certificate/vendor/autoload.php');
        require_once $autoload_url;

        $options =  new Options( apply_filters( 'certificate_dompdf_options', array(
            'defaultFont'				=> 'sans',
            'isRemoteEnabled'			=> true,
            'isFontSubsettingEnabled'	=> true,
            // HTML5 parser requires iconv
            'isHtml5ParserEnabled'		=> extension_loaded('iconv') ? true : false,
        ) ) );

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($this->content());
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        if ($this->debug){
            $dompdf->stream("certificate.pdf", array("Attachment" => false));
            exit(0);
        }
        $dompdf->stream("certificate.pdf");
    }


    public function content(){
        $certificate_path = $this->layouts_path.$this->layout;

        ob_start();
        include $certificate_path.'/certificate.php';
        $content = ob_get_clean();

        return $content;
    }


    public function certificateSettings(){
        $title = "Certificate Settings";
        return view('plugin:certificate::certificate_settings', compact('title'));
    }

}
