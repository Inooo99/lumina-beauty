<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun Admin
        User::create([
            'name' => 'Admin Lumina',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Password admin
        ]);
    }
}