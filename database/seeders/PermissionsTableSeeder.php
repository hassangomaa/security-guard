<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'name' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'name' => 'permission_create',
            ],
            [
                'id'    => 3,
                'name' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'name' => 'permission_show',
            ],
            [
                'id'    => 5,
                'name' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'name' => 'permission_access',
            ],
            [
                'id'    => 7,
                'name' => 'role_create',
            ],
            [
                'id'    => 8,
                'name' => 'role_edit',
            ],
            [
                'id'    => 9,
                'name' => 'role_show',
            ],
            [
                'id'    => 10,
                'name' => 'role_delete',
            ],
            [
                'id'    => 11,
                'name' => 'role_access',
            ],
            [
                'id'    => 12,
                'name' => 'user_create',
            ],
            [
                'id'    => 13,
                'name' => 'user_edit',
            ],
            [
                'id'    => 14,
                'name' => 'user_show',
            ],
            [
                'id'    => 15,
                'name' => 'user_delete',
            ],
            [
                'id'    => 16,
                'name' => 'user_access',
            ],
            [
                'id'    => 17,
                'name' => 'product_create',
            ],
            [
                'id'    => 18,
                'name' => 'product_edit',
            ],
            [
                'id'    => 19,
                'name' => 'product_show',
            ],
            [
                'id'    => 20,
                'name' => 'product_delete',
            ],
            [
                'id'    => 21,
                'name' => 'product_access',
            ],
            [
                'id'    => 22,
                'name' => 'category_create',
            ],
            [
                'id'    => 23,
                'name' => 'category_edit',
            ],
            [
                'id'    => 24,
                'name' => 'category_show',
            ],
            [
                'id'    => 25,
                'name' => 'category_delete',
            ],
            [
                'id'    => 26,
                'name' => 'category_access',
            ],
            [
                'id'    => 27,
                'name' => 'detail_create',
            ],
            [
                'id'    => 28,
                'name' => 'detail_edit',
            ],
            [
                'id'    => 29,
                'name' => 'detail_show',
            ],
            [
                'id'    => 30,
                'name' => 'detail_delete',
            ],
            [
                'id'    => 31,
                'name' => 'detail_access',
            ],
            [
                'id'    => 32,
                'name' => 'variation_create',
            ],
            [
                'id'    => 33,
                'name' => 'variation_edit',
            ],
            [
                'id'    => 34,
                'name' => 'variation_show',
            ],
            [
                'id'    => 35,
                'name' => 'variation_delete',
            ],
            [
                'id'    => 36,
                'name' => 'variation_access',
            ],
            [
                'id'    => 37,
                'name' => 'service_create',
            ],
            [
                'id'    => 38,
                'name' => 'service_edit',
            ],
            [
                'id'    => 39,
                'name' => 'service_show',
            ],
            [
                'id'    => 40,
                'name' => 'service_delete',
            ],
            [
                'id'    => 41,
                'name' => 'service_access',
            ],
            [
                'id'    => 42,
                'name' => 'image_create',
            ],
            [
                'id'    => 43,
                'name' => 'image_edit',
            ],
            [
                'id'    => 44,
                'name' => 'image_delete',
            ],
            [
                'id'    => 45,
                'name' => 'image_access',
            ],
            [
                'id'    => 46,
                'name' => 'brand_create',
            ],
            [
                'id'    => 47,
                'name' => 'brand_edit',
            ],
            [
                'id'    => 48,
                'name' => 'brand_show',
            ],
            [
                'id'    => 49,
                'name' => 'brand_delete',
            ],
            [
                'id'    => 50,
                'name' => 'brand_access',
            ],
            [
                'id'    => 51,
                'name' => 'modeel_create',
            ],
            [
                'id'    => 52,
                'name' => 'modeel_edit',
            ],
            [
                'id'    => 53,
                'name' => 'modeel_show',
            ],
            [
                'id'    => 54,
                'name' => 'modeel_delete',
            ],
            [
                'id'    => 55,
                'name' => 'modeel_access',
            ],
            [
                'id'    => 56,
                'name' => 'year_create',
            ],
            [
                'id'    => 57,
                'name' => 'year_edit',
            ],
            [
                'id'    => 58,
                'name' => 'year_show',
            ],
            [
                'id'    => 59,
                'name' => 'year_delete',
            ],
            [
                'id'    => 60,
                'name' => 'year_access',
            ],
            [
                'id'    => 61,
                'name' => 'engine_capacity_cc_create',
            ],
            [
                'id'    => 62,
                'name' => 'engine_capacity_cc_edit',
            ],
            [
                'id'    => 63,
                'name' => 'engine_capacity_cc_show',
            ],
            [
                'id'    => 64,
                'name' => 'engine_capacity_cc_delete',
            ],
            [
                'id'    => 65,
                'name' => 'engine_capacity_cc_access',
            ],
            [
                'id'    => 66,
                'name' => 'profile_password_edit',
            ],
        ];
                 foreach ($permissions as $permission) {
            $permission['guard_name'] = 'web';
            Permission::create($permission);
        }

        
    }
}
