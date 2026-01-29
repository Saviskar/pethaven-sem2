<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure role 1 exists, just in case, though user implied it does.
        // If Role model creates ID 1 automatically, good. If not, we might need to create it.
        // But better to stick to exactly what user asked: create user with role_id 1.
        
        User::updateOrCreate(
            ['email' => 'admin@pethaven.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('11111111'),
                'role_id' => 1,
            ]
        );
        
        $this->command->info('Admin user created successfully.');
    }
}
