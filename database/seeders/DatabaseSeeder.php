<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tài khoản Quản trị viên (Admin Role)
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Quản trị viên Hệ thống',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 2. Tài khoản Người dùng thông thường (User Role)
        User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Người dùng Thành viên',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );
    }
}