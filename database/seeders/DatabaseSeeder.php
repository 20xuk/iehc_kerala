<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create System Administrator
        User::factory()->create([
            'name' => 'System Administrator',
            'email' => 'admin@iehc.com',
            'password' => bcrypt('password'),
            'role' => 'system_admin',
            'password_change_required' => true,
        ]);

        // Create Office Staff
        User::factory()->create([
            'name' => 'Office Staff',
            'email' => 'staff@iehc.com',
            'password' => bcrypt('password'),
            'role' => 'office_staff',
            'password_change_required' => true,
        ]);

        // Create Accountant
        User::factory()->create([
            'name' => 'Accountant',
            'email' => 'accountant@iehc.com',
            'password' => bcrypt('password'),
            'role' => 'accountant',
            'password_change_required' => true,
        ]);

        // Create Promotional Secretary
        User::factory()->create([
            'name' => 'Promotional Secretary',
            'email' => 'secretary@iehc.com',
            'password' => bcrypt('password'),
            'role' => 'secretary',
            'password_change_required' => true,
        ]);

        // Create Sample Donor
        User::factory()->create([
            'name' => 'Sample Donor',
            'email' => 'donor@iehc.com',
            'password' => bcrypt('password'),
            'role' => 'donor',
            'password_change_required' => true,
        ]);

        // Create additional test users if needed
        // User::factory(5)->create();
        
        // Call other seeders
        $this->call([
            SystemSettingSeeder::class,
            ThemeSeeder::class,
        ]);
    }
}
