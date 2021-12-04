<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Wipe user table.
        User::truncate();

        // Create a new user.
        User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('vaultipass'),
        ]);
    }
}