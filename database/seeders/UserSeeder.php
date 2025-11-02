<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Cliente;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create or update a test/admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('secret'), // password: secret
            ]
        );

        // Ensure admin also has a Cliente/profile row with admin role (internal only)
        $admin = User::where('email', 'admin@example.com')->first();
        $adminRole = Role::where('name', 'admin')->first();
        if ($admin && $adminRole) {
            Cliente::updateOrCreate(
                ['user_id' => $admin->id],
                ['role_id' => $adminRole->id]
            );
        }
    }
}
