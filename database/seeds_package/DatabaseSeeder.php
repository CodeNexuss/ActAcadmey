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
        $this->call(UsersTableSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(OptionSeeder::class);
        $this->call(Database\Seeders\LanguagesTableSeeder::class);
        // $this->call(Database\Seeders\CategoriesTableSeeder::class);
    }
}
