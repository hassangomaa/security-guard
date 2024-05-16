<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@app.com',
            "phone" => "01000000000",
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'user_type' => 'USER', // Assuming default user type is 'customer'
        ]);

        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin2@app.com',
            "phone" => "010000000123",
            //email_verified_at
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'),
            'user_type' => 'ADMIN', // Assuming admin user type is 'admin'
        ]);

        User::factory(20)->create();
    }
}
