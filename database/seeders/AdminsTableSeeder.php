<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'name' => 'Admin User 1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('password123')
        ]);

        Admin::create([
            'name' => 'Admin User 2',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password123')
        ]);

        Admin::create([
            'name' => 'Admin User 3',
            'email' => 'admin3@example.com',
            'password' => Hash::make('password123')
        ]);

        Admin::create([
            'name' => 'Admin User 4',
            'email' => 'admin4@example.com',
            'password' => Hash::make('password123')
        ]);

        Admin::create([
            'name' => 'Admin User 5',
            'email' => 'admin5@example.com',
            'password' => Hash::make('password123')
        ]);
    }
}
