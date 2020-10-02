<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission, Role};
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin permissions
        Permission::create(['name' => 'manage_products']);

        // Assign permissions to admin role
        $admin = Role::where('name', 'Admin')->first();
        $permissions = Permission::all()->pluck('name');
        $admin->givePermissionTo($permissions);
    }
}
