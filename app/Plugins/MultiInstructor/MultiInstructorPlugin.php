<?php
namespace App\Plugins\MultiInstructor;

use App\Module\PluginBase;

class MultiInstructorPlugin extends PluginBase {

    public $name = 'Multi Instructor';
    public $slug = 'multi_instructor';
    
    public function boot(){
        $this->enableRoutes();
        $this->enableViews();

        add_filter('course_edit_nav_items', [$this, 'add_course_nav_item']);
    }


    public function add_course_nav_item($nav_items){
        $nav_items['edit_course_instructors'] = [
            'name' => __t('instructors'),
            'icon' => '<i class="la la-chalkboard-teacher"></i>',
            'is_active' => request()->is('dashboard/courses/*/instructors*'),
        ];

        return $nav_items;
    }

}
