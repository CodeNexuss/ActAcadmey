<?php
namespace App\Plugins\StudentsProgress;

use App\Module\PluginBase;

class StudentsProgressPlugin extends PluginBase {

    public $name = 'Students Progress Report';
    public $slug = 'students_progress_report';

    public function boot(){
        $this->enableRoutes();
        $this->enableViews();

        // add_filter('dashboard_menu_items', [$this, 'add_menu_to_dashboard']);
        add_filter('dashboard_submenu_items', [$this, 'add_submenu_to_dashboard']);
        add_action('my_courses_list_actions_after', [$this, 'add_report_link']);
    }

    // public function add_menu_to_dashboard($items){
    //     $items['student_progress'] = [
    //         'name' => __t('students_progress_report'),
    //         'icon' => '<i class="la la-pie-chart"></i>',
    //         'is_active' => request()->is('dashboard/students-progress*'),
    //     ];

    //     return $items;
    // }

    public function add_submenu_to_dashboard($items){
        $items['student_progress'] = [
            'name' => __t('students_progress_report'),
            'icon' => '<i class="la la-pie-chart"></i>',
            'url' => route('student_progress'),
            'is_active' => request()->is('dashboard/students-progress*'),
        ];

        return $items;
    }

    public function add_report_link($course){
        $route = route('student_progress', $course->id);

        echo "<a href='{$route}' class='font-weight-bold mr-3'> <i class='la la-pie-chart'></i> ".__t('students_progress_report')." </a>";
    }



}
