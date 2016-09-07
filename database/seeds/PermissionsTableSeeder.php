<?php

use App\Entities\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'operator']);
        Role::create(['name' => 'patient']);

        $user = User::find(1);
        $user->assignRole('operator');
    }
}
