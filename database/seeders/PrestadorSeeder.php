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
            $this->call(CategoriaSeeder::class);
        }

        if (Endereco::count() === 0) {
            $this->call(EnderecoSeeder::class);
        }

        $categorias = Categoria::all();
        $enderecos = Endereco::all();

        if ($categorias->isEmpty() || $enderecos->isEmpty()) {
            $this->command->error('Categorias ou endereços não encontrados!');
            return;
        }

        $this->criarPrestadoresPrincipais($categorias, $enderecos);
        $this->criarPrestadoresAleatorios($categorias, $enderecos);

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
            PrestadorFactory::new()->create([
                'user_id' => $usuarioPrincipal->id,
                'documento' => '12.345.678/0001-90',
                'telefone' => '(11) 99999-8888',
                'categoria_id' => $categorias->where('slug', 'eletricista')->first()->id,
                'endereco_id' => $enderecos->random()->id,
            ]);
        }
    }

    private function criarPrestadoresAleatorios($categorias, $enderecos): void
    {
        $quantidade = 10; 
        $existentes = Prestador::count();
        
        if ($existentes >= $quantidade) {
            $this->command->info("Já existem {$existentes} prestadores. Não criando novos.");
            return;
        }
        
        $criar = $quantidade - $existentes;
        
        $this->command->info("Criando {$criar} prestadores aleatórios...");
        
        PrestadorFactory::new()->count($criar)->create([
        ]);
        
        $this->command->info("{$criar} prestadores aleatórios criados com sucesso.");
    }
}