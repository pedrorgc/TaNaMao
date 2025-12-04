<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Iniciando seeding do banco de dados...');
        
        // --- CORREÇÃO 1: Lógica Condicional para desativar Foreign Keys ---
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;'); // Comando correto para SQLite
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;'); // Mantém o comando para MySQL/outros
        }
        // --- FIM CORREÇÃO 1 ---
        
        try {
            $this->criarUsuariosPrincipais();
            
            $this->call([
                RoleSeeder::class,           
                CategoriaSeeder::class,    
                EnderecoSeeder::class,     
                ClienteSeeder::class,      
                PrestadorSeeder::class,    
                ServicoSeeder::class,      
            ]);
            
            $this->command->info('Seeding concluído com sucesso!');
            
        } catch (\Exception $e) {
            $this->command->error('Erro durante o seeding: ' . $e->getMessage());
            $this->command->error('Trace: ' . $e->getTraceAsString());
        } finally {
            // --- CORREÇÃO 2: Lógica Condicional para reativar Foreign Keys ---
            if (DB::getDriverName() === 'sqlite') {
                DB::statement('PRAGMA foreign_keys = ON;'); // Comando correto para SQLite
            } else {
                DB::statement('SET FOREIGN_KEY_CHECKS=1;'); // Mantém o comando para MySQL/outros
            }
            // --- FIM CORREÇÃO 2 ---
        }
        
        $this->mostrarResumo();
    }
    
    private function criarUsuariosPrincipais(): void
    {
        $this->command->info('Criando usuários principais...');
        
        try {
            if (!DB::table('roles')->exists()) {
                $this->call(RoleSeeder::class);
            }
        } catch (\Exception $e) {
            $this->command->warn('Tabela roles pode não existir ainda: ' . $e->getMessage());
        }
        
        $usuarios = [
            [
                'email' => 'admin@example.com',
                'name' => 'Admin User',
                'role_id' => 1,
            ],
            [
                'email' => 'prestador@example.com',
                'name' => 'Prestador User',
                'role_id' => 2,
            ],
            [
                'email' => 'test@example.com',
                'name' => 'Test User',
                'role_id' => 3,
            ],
        ];
        
        foreach ($usuarios as $usuario) {
            $existing = User::where('email', $usuario['email'])->first();
            
            if ($existing) {
                $existing->update([
                    'name' => $usuario['name'],
                    'role_id' => $usuario['role_id'],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                ]);
                $this->command->info("Usuário '{$usuario['email']}' atualizado.");
            } else {
                User::create([
                    'name' => $usuario['name'],
                    'email' => $usuario['email'],
                    'role_id' => $usuario['role_id'],
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                ]);
                $this->command->info("Usuário '{$usuario['email']}' criado.");
            }
        }
        
        $this->command->info('Usuários principais processados.');
    }
    
    private function mostrarResumo(): void
    {
        $this->command->info('');
        $this->command->info('=== RESUMO DO BANCO DE DADOS ===');
        
        try {
            $this->command->info('Usuários: ' . User::count());
            
            if (DB::table('roles')->exists()) {
                $this->command->info('Roles: ' . DB::table('roles')->count());
            }
            
            if (DB::table('categorias')->exists()) {
                $this->command->info('Categorias: ' . DB::table('categorias')->count());
            }
            
            if (DB::table('enderecos')->exists()) {
                $this->command->info('Endereços: ' . DB::table('enderecos')->count());
            }
            
            if (DB::table('prestadores')->exists()) {
                $this->command->info('Prestadores: ' . DB::table('prestadores')->count());
            }
            
            if (DB::table('servicos')->exists()) {
                $this->command->info('Serviços: ' . DB::table('servicos')->count());
            }
        } catch (\Exception $e) {
            $this->command->warn('Erro ao contar registros: ' . $e->getMessage());
        }
        
        $this->command->info('===============================');
    }
}