<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nama_user' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'admin'
        ]);

        User::create([
            'nama_user' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'staff'
        ]);
    }
}
