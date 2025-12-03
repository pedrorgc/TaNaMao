<?php

namespace Database\Seeders;

use App\Models\Prestador;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Endereco;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Database\Factories\PrestadorFactory;

class PrestadorSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Criando prestadores...');

        if (Categoria::count() === 0) {
            $this->command->info('Nenhuma categoria encontrada. Executando CategoriaSeeder...');
            $this->call(CategoriaSeeder::class);
        }

        if (Endereco::count() === 0) {
            $this->command->info('Nenhum endereço encontrado. Executando EnderecoSeeder...');
            $this->call(EnderecoSeeder::class);
        }

        $categorias = Categoria::all();
        $enderecos = Endereco::all();

        if ($categorias->isEmpty()) {
            $this->command->error('Não há categorias cadastradas! Execute o CategoriaSeeder primeiro.');
            return;
        }

        if ($enderecos->isEmpty()) {
            $this->command->error('Não há endereços cadastrados! Execute o EnderecoSeeder primeiro.');
            return;
        }

        $this->criarPrestadoresPrincipais($categorias, $enderecos);
        $this->criarPrestadoresAleatorios();

        $this->command->info('Prestadores criados com sucesso!');
        $this->command->info('Total: ' . Prestador::count() . ' prestadores criados.');
    }

    private function criarPrestadoresPrincipais($categorias, $enderecos): void
    {
        $usuarioPrincipal = User::firstOrCreate(
            ['email' => 'prestador@example.com'],
            [
                'name' => 'Prestador Profissional',
                'role_id' => 2,
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
            ]
        );

        if (!Prestador::where('user_id', $usuarioPrincipal->id)->exists()) {
            $categoriaEletricista = $categorias->where('slug', 'eletricista')->first();
            
            if (!$categoriaEletricista) {
                $categoriaEletricista = $categorias->first();
            }

            PrestadorFactory::new()->create([
                'user_id' => $usuarioPrincipal->id,
                'documento' => '12.345.678/0001-90',
                'telefone' => '(11) 99999-8888',
                'categoria_id' => $categoriaEletricista->id,
                'endereco_id' => $enderecos->random()->id,
            ]);
        }
    }

    private function criarPrestadoresAleatorios(): void
    {
        $quantidadeTotal = 10; 
        $existentes = Prestador::count();
        
        if ($existentes >= $quantidadeTotal) {
            $this->command->info("Já existem {$existentes} prestadores. Não criando novos.");
            return;
        }
        
        $criar = $quantidadeTotal - $existentes;
        
        $this->command->info("Criando {$criar} prestadores aleatórios...");
        
        $lote = 3;
        for ($i = 0; $i < ceil($criar / $lote); $i++) {
            $criarAgora = min($lote, $criar - ($i * $lote));
            if ($criarAgora <= 0) break;
            
            $this->command->info("Criando lote de {$criarAgora} prestadores...");
            PrestadorFactory::new()->count($criarAgora)->create();
        }
        
        $this->command->info("{$criar} prestadores aleatórios criados com sucesso.");
    }
}