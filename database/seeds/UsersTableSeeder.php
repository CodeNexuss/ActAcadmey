<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array('id' => '1','name' => 'Margaret B. Davis','email' => 'admin@demo.com','email_verified_at' => NULL,'password' => '$2y$10$OGRNTfj1nuCuvhOvQgLjZ.XgROG0cSXUplackHaW08m4n/OelSBaC','gender' => 'female','company_name' => NULL,'country_id' => NULL,'address' => NULL,'address_2' => NULL,'city' => NULL,'zip_code' => NULL,'postcode' => NULL,'website' => NULL,'phone' => NULL,'about_me' => NULL,'date_of_birth' => NULL,'photo' => NULL,'job_title' => NULL,'options' => '{"enrolled_courses":[1,6,10],"completed_courses":{"1":{"percent":100,"content_ids":[3,4,5,25,9,10]},"6":{"percent":75,"content_ids":[26,27,28,29,30,32]},"10":{"percent":75,"content_ids":[59,60,61]}},"wishlists":[]}','user_type' => 'admin','active_status' => '1','provider_user_id' => NULL,'provider' => NULL,'reset_token' => NULL,'remember_token' => NULL,'created_at' => NULL,'updated_at' => '2021-12-30 00:34:09', 'last_wished_course'=>NULL, 'last_viewed_course'=>NULL),
            array('id' => '2','name' => 'Trioangle','email' => 'trioangleudify@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$e/PgDDgvpxYlmUOAYDFod.Jyi/UUoojGwKgGkbfRJPfYn3MbptECO','gender' => 'female','company_name' => NULL,'country_id' => NULL,'address' => NULL,'address_2' => NULL,'city' => NULL,'zip_code' => NULL,'postcode' => NULL,'website' => NULL,'phone' => NULL,'about_me' => NULL,'date_of_birth' => NULL,'photo' => '252','job_title' => NULL,'options' => '{"social":{"website":null,"twitter":null,"facebook":null,"linkedin":null,"youtube":null,"instagram":null}}','user_type' => 'instructor','active_status' => '1','provider_user_id' => NULL,'provider' => NULL,'reset_token' => NULL,'remember_token' => NULL,'created_at' => NULL,'updated_at' => '2021-12-29 22:32:22', 'last_wished_course'=>NULL, 'last_viewed_course'=>NULL),
            array('id' => '5','name' => 'mike','email' => 'mike@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$sVoMeGQac5uCbpcodkyXN.OAH0bDVBonk79KSGrZJmbPaRSbQ1xg.','gender' => NULL,'company_name' => NULL,'country_id' => NULL,'address' => NULL,'address_2' => NULL,'city' => NULL,'zip_code' => NULL,'postcode' => NULL,'website' => NULL,'phone' => NULL,'about_me' => NULL,'date_of_birth' => NULL,'photo' => '253','job_title' => NULL,'options' => '{"social":{"website":null,"twitter":null,"facebook":null,"linkedin":null,"youtube":null,"instagram":null}}','user_type' => 'instructor','active_status' => '1','provider_user_id' => NULL,'provider' => NULL,'reset_token' => NULL,'remember_token' => NULL,'created_at' => '2021-12-22 20:35:26','updated_at' => '2021-12-29 22:34:53', 'last_wished_course'=>NULL, 'last_viewed_course'=>NULL),
            array('id' => '6','name' => 'Alvaro Morte','email' => 'wilson@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$DpQNoskShvvuoZ9yFo5NNeHZAS9A4lqZdbyObrN.YnMY57fj6DPHW','gender' => NULL,'company_name' => NULL,'country_id' => NULL,'address' => NULL,'address_2' => NULL,'city' => NULL,'zip_code' => NULL,'postcode' => NULL,'website' => NULL,'phone' => NULL,'about_me' => NULL,'date_of_birth' => NULL,'photo' => '254','job_title' => NULL,'options' => '{"social":{"website":null,"twitter":null,"facebook":null,"linkedin":null,"youtube":null,"instagram":null}}','user_type' => 'instructor','active_status' => '1','provider_user_id' => NULL,'provider' => NULL,'reset_token' => NULL,'remember_token' => NULL,'created_at' => '2021-12-23 02:17:45','updated_at' => '2021-12-29 22:38:04', 'last_wished_course'=>NULL, 'last_viewed_course'=>NULL),
            array('id' => '10','name' => 'Tony','email' => 'tony@gmail.com','email_verified_at' => NULL,'password' => '$2y$10$9tHwxNNmefLZ6SyCq9.TmOfekE3gcfg1tqMreiwXShnwLjtXr3fSm','gender' => NULL,'company_name' => NULL,'country_id' => NULL,'address' => NULL,'address_2' => NULL,'city' => NULL,'zip_code' => NULL,'postcode' => NULL,'website' => NULL,'phone' => NULL,'about_me' => NULL,'date_of_birth' => NULL,'photo' => '255','job_title' => NULL,'options' => '{"enrolled_courses":[21],"completed_courses":{"21":{"percent":80,"content_ids":[117,118,119,120]}},"social":{"website":null,"twitter":null,"facebook":null,"linkedin":null,"youtube":null,"instagram":null}}','user_type' => 'instructor','active_status' => '1','provider_user_id' => NULL,'provider' => NULL,'reset_token' => NULL,'remember_token' => NULL,'created_at' => '2021-12-24 01:42:01','updated_at' => '2021-12-29 22:39:25', 'last_wished_course'=>NULL, 'last_viewed_course'=>NULL),
        );

        \Illuminate\Support\Facades\DB::table('users')->insert(
            $users
        );
    }
}
