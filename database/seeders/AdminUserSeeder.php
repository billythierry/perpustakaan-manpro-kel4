<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;   

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'password_hash' => Hash::make('admin123'),
                'email' => 'admin123@gmail.com',
                'address' => 'groove street',
                'role' => 'admin',
            ]
        );
    }
    
}
