<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CourseUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course_user = array(
            array('id' => '1','course_id' => '1','user_id' => '2','permissions' => NULL,'added_at' => '2021-12-22 18:11:54'),
            array('id' => '2','course_id' => '2','user_id' => '5','permissions' => NULL,'added_at' => '2021-12-22 20:36:16'),
            array('id' => '3','course_id' => '3','user_id' => '6','permissions' => NULL,'added_at' => '2021-12-23 02:20:36'),
            array('id' => '6','course_id' => '6','user_id' => '2','permissions' => NULL,'added_at' => '2021-12-23 18:31:46'),
            array('id' => '7','course_id' => '7','user_id' => '7','permissions' => NULL,'added_at' => '2021-12-23 18:58:17'),
            array('id' => '8','course_id' => '8','user_id' => '2','permissions' => NULL,'added_at' => '2021-12-23 18:59:01'),
            array('id' => '9','course_id' => '9','user_id' => '2','permissions' => NULL,'added_at' => '2021-12-23 19:22:10'),
            array('id' => '10','course_id' => '10','user_id' => '2','permissions' => NULL,'added_at' => '2021-12-23 22:10:33'),
            array('id' => '11','course_id' => '11','user_id' => '5','permissions' => NULL,'added_at' => '2021-12-23 23:41:06'),
            array('id' => '12','course_id' => '12','user_id' => '5','permissions' => NULL,'added_at' => '2021-12-24 01:24:02'),
            array('id' => '13','course_id' => '13','user_id' => '5','permissions' => NULL,'added_at' => '2021-12-24 01:27:44'),
            array('id' => '14','course_id' => '14','user_id' => '5','permissions' => NULL,'added_at' => '2021-12-24 01:29:55'),
            array('id' => '15','course_id' => '15','user_id' => '6','permissions' => NULL,'added_at' => '2021-12-24 01:33:39'),
            array('id' => '16','course_id' => '16','user_id' => '6','permissions' => NULL,'added_at' => '2021-12-24 01:36:01'),
            array('id' => '17','course_id' => '17','user_id' => '6','permissions' => NULL,'added_at' => '2021-12-24 01:37:59'),
            array('id' => '18','course_id' => '18','user_id' => '6','permissions' => NULL,'added_at' => '2021-12-24 01:40:05'),
            array('id' => '19','course_id' => '19','user_id' => '10','permissions' => NULL,'added_at' => '2021-12-24 01:44:04'),
            array('id' => '20','course_id' => '20','user_id' => '10','permissions' => NULL,'added_at' => '2021-12-24 01:49:24'),
            array('id' => '21','course_id' => '21','user_id' => '10','permissions' => NULL,'added_at' => '2021-12-24 01:51:41'),
            array('id' => '22','course_id' => '22','user_id' => '10','permissions' => NULL,'added_at' => '2021-12-24 01:54:14'),
            array('id' => '23','course_id' => '23','user_id' => '10','permissions' => NULL,'added_at' => '2021-12-24 01:56:22'),
            array('id' => '24','course_id' => '24','user_id' => '1','permissions' => NULL,'added_at' => '2021-12-24 16:15:00')
        );

        \Illuminate\Support\Facades\DB::table('course_user')->insert(
            $course_user
        );
    }
}
