<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionsSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        // Define your roles and permissions here

        $rolePermissions = [
            'Admin' => [
                'permission_name_1',
                'permission_name_2',
            ],
            'Suppler' => [
                'permission_name_3',
                'permission_name_4',
            ],
        ];

        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();

            foreach ($permissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                $role->givePermissionTo($permission);
            }
        }
    }
}
