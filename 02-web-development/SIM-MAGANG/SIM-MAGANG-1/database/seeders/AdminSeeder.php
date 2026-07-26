<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing admins to avoid confusion
        Admin::truncate();

        Admin::create([
             'username' => 'admin',
             'email' => 'admin@gmail.com',
             'password' => Hash::make('admin123'),
         ]);
    }
}
