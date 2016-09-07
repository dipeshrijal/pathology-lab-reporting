<?php

use App\Entities\User;
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
        User::create([
            'name'           => 'operator',
            'email'          => 'operator@example.com',
            'phone'          => '1234567890',
            'password'       => bcrypt('secret'),
            'remember_token' => str_random(30),
        ]);
    }
}
