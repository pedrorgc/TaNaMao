<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\ClientesSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            ClienteSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => 1, // Admin
        ]);

        User::factory()->create([
            'name' => 'Prestador User',
            'email' => 'prestador@example.com',
            'role_id' => 2, // Prestador
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => 3, // Cliente (padrão)
        ]);
    }
}
