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
        App\User::create(['name' => 'Bart', 'email' => 'bartjakobs@gmail.com', 'password' => bcrypt('password')]);
        App\User::create(['name' => 'Test User', 'email' => 'test@bartjakobs.nl', 'password' => bcrypt('test')]);
    }
}
