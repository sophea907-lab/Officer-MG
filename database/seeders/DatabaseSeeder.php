<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create or ensure Default Admin User for local development
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Seed 8 Departments
        $this->call(DepartmentSeeder::class);

        // 3. Seed 12 Positions
        $this->call(PositionSeeder::class);

        // 4. Seed 35 Officers
        $this->call(OfficerSeeder::class);
    }
}
