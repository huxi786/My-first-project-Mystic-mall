<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'admin@mysticmall.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'), // You can change this later
                'is_admin' => true,
            ]
        );
    }
}
