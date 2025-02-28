<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Deborah',
            'email' => 'Deborah@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);
    }
}
