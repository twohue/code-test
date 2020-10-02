<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create roles
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Customer']);

        // Assign roles to users
        $users = User::all();
        foreach($users as $index => $user) {
            if($index === 0) {
                $user->assignRole('Admin');
            } else {
                $user->assignRole('Customer');
            }
        }

    }
}
