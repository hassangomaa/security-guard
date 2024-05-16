<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'name' => 'Admin',
            ],
            [
                'id'    => 2,
                'name' => 'Suppler',
            ],
            [
                'id'    => 3,
                'name' => 'Customer',
            ],
            [
                'id'    => 4,
                'name' => 'Service',
            ],
        ];
             foreach ($roles as $role) {
            $role['guard_name'] = 'web';
               Role::create($role)
               ;
 }

    }
}
