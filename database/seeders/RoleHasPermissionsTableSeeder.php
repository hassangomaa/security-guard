<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


 
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionsTableSeeder extends Seeder
{
 public function run()
    {
        // Get the roles and permissions
        $adminRole = Role::where('name', 'Admin')->first();
        $permissions = Permission::all();

        // Attach permissions to the admin role
        $adminRole->syncPermissions($permissions);
    }
}
