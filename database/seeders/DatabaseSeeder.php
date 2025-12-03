<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {   
         $this->command->info('Iniciando seeding do banco de dados...');

        $this->criarUsuariosPrincipais();

         $this->call([
            RoleSeeder::class,
            CategoriaSeeder::class,
            EnderecoSeeder::class,
            ClienteSeeder::class,
            PrestadorSeeder::class,  
            ServicoSeeder::class,     
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Prestador User',
            'email' => 'prestador@example.com',
            'role_id' => 2,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => 3,
        ]);
    }
}
