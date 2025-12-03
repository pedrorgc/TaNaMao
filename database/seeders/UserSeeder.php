<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->admin()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::factory()->prestador()->create([
            'name' => 'Prestador User',
            'email' => 'prestador@example.com',
            'password' => Hash::make('password123'),
        ]);

         User::factory()->cliente()->create([
            'name' => 'Cliente User',
            'email' => 'cliente@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::factory()->count(10)->create();
        
        $this->command->info('Usuários criados com sucesso!');
    }
}