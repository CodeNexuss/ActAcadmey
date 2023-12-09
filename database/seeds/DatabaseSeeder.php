<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(Database\Seeders\PostsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(Database\Seeders\LanguagesTableSeeder::class);
        $this->call(Database\Seeders\CategoriesTableSeeder::class);
        
        $this->call(Database\Seeders\AttachmentsTableSeeder::class);
        $this->call(Database\Seeders\ContentsTableSeeder::class);
        $this->call(Database\Seeders\CoursesTableSeeder::class);
        $this->call(Database\Seeders\CourseUserTableSeeder::class);
        $this->call(Database\Seeders\MediaTableSeeder::class);
        $this->call(Database\Seeders\QuestionsTableSeeder::class);
        $this->call(Database\Seeders\QuestionOptionsTableSeeder::class);
        $this->call(Database\Seeders\SectionsTableSeeder::class);
        $this->call(Database\Seeders\HomepageSliderTableSeeder::class);
    }
}
