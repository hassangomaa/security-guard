<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Blog;
use App\Models\Family;
use App\Models\Person;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
        /**
         * Seed the application's database.
         */
        public function run(): void
        {


                $this->call(
                        [

                                PermissionsTableSeeder::class,
                                RolesTableSeeder::class,
                                PermissionRoleTableSeeder::class,
                                UsersTableSeeder::class,
                                RoleUserTableSeeder::class,
                                RoleHasPermissionsTableSeeder::class,
                                RoleHasPermissionsSeeder::class,
                        ]
                );

                // $this->call(CategorySeeder::class);
                // $this->call(OrderSeeder::class);
                $this->call(UserSeeder::class);
                \App\Models\Contact::factory(10)->create();
                Blog::factory(10)->create(); // Create 10 blog entries using the BlogFactory


                // $this->call(FeeTypeSeeder::class);
                // Family::factory(20)->create();

                // Person::factory(20)->create();
        }
}
