<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'ADMIN Security Shield',
            'email' => 'admin@app.com',
            'password' => bcrypt('12345678'),
            'phone' => '+971123456789',
            'email_verified_at' => now(),
            'lang' => 'en',
        ]);
    }
}
