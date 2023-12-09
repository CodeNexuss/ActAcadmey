<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HomepageSliderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homepage_sliders = array(
            array('id' => '1','title' => 'Be your own hero','description' => 'Our New offer sale ends today. Skill up with courses from ₹455 until this month.','image' => '256','url' => NULL,'status' => '1','order' => '1','created_at' => '2022-01-27 15:52:05','updated_at' => '2022-01-27 15:52:05'),
            array('id' => '2','title' => 'Java Course','description' => 'Java Course is about helping students learn the concepts of programming and help them solve complex problems. ... This Certification Course tries to inculcate the knowledge','image' => '257','url' => NULL,'status' => '1','order' => '2','created_at' => '2022-01-27 15:53:25','updated_at' => '2022-01-27 15:53:25')
        );

        \Illuminate\Support\Facades\DB::table('homepage_sliders')->insert(
            $homepage_sliders
        );
    }
}
