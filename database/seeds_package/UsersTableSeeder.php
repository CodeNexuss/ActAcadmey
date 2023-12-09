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
        \Illuminate\Support\Facades\DB::table('users')->insert(
            [
                0 => [
                    'name'      => 'Margaret B. Davis',
                    'email'     => 'admin@demo.com',
                    'password'  => bcrypt('123456'),
                    'user_type' => 'admin',
                    'active_status' => 1,
                    'gender' => 'female',
                ]
            ]
        );
    }
}
