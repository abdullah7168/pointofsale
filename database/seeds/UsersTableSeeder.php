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
        DB::table('users')->insert([
            'name' => 'Syed Abdullah',
            'username' => 'abdullah',
            'email' => 'sabdullah.978@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
