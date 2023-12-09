<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = array(
            array('id' => '1','name' => 'English','value' => 'en','status' => '1','default_language' => '1'),
            // array('id' => '2','name' => 'العربية','value' => 'ar','status' => '1','default_language' => '0'),
            // array('id' => '3','name' => 'French','value' => 'fr','status' => '1','default_language' => '0'),
            // array('id' => '4','name' => 'Española','value' => 'es','status' => '1','default_language' => '0')
        );

        \Illuminate\Support\Facades\DB::table('languages')->insert(
            $languages
        );
    }
}
