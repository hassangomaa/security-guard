<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        // User::findOrFail(1)->roles()->sync(1);
        // Get the first user from the database
        $user = User::first();
        $user->roles()->sync([1]);

        // // Assuming you have the UUID of the role you want to sync
        // $roleUuid = 1;

        // // Find the role by UUID
        // $role = Role::where('id', $roleUuid)->firstOrFail();

        // // Sync the roles for the user
        // $user->roles()->sync([$role->id]);

    }
}
