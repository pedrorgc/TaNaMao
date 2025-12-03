<?php

namespace Database\Seeders;

use App\Models\Endereco;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    public function run(): void
    {
        $enderecos = [
            [
                'logradouro' => 'Rua das Flores',
                'numero' => '123',
                'complemento' => 'Ap 101',
                'bairro' => 'Centro',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
                'cep' => '01001-000',
                'pais' => 'Brasil'
            ],
            [
                'logradouro' => 'Avenida Paulista',
                'numero' => '1000',
                'complemento' => 'Sala 501',
                'bairro' => 'Bela Vista',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
                'cep' => '01310-100',
                'pais' => 'Brasil'
            ],
            [
                'logradouro' => 'Rua do Comércio',
                'numero' => '456',
                'complemento' => 'Loja 2',
                'bairro' => 'Centro',
                'cidade' => 'Rio de Janeiro',
                'estado' => 'RJ',
                'cep' => '20010-020',
                'pais' => 'Brasil'
            ],
            [
                'logradouro' => 'Rua das Palmeiras',
                'numero' => '789',
                'complemento' => null,
                'bairro' => 'Jardins',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
                'cep' => '01410-001',
                'pais' => 'Brasil'
            ],
            [
                'logradouro' => 'Avenida Brasil',
                'numero' => '2000',
                'complemento' => 'Bloco B',
                'bairro' => 'Centro',
                'cidade' => 'Belo Horizonte',
                'estado' => 'MG',
                'cep' => '30140-002',
                'pais' => 'Brasil'
            ],
            [
                'logradouro' => 'Rua do Sol',
                'numero' => '321',
                'complemento' => 'Casa',
                'bairro' => 'Praia do Canto',
                'cidade' => 'Vitória',
                'estado' => 'ES',
                'cep' => '29055-000',
                'pais' => 'Brasil'
            ],
            [
                'logradouro' => 'Rua da Paz',
                'numero' => '654',
                'complemento' => 'Ap 302',
                'bairro' => 'Moinhos de Vento',
                'cidade' => 'Porto Alegre',
                'estado' => 'RS',
                'cep' => '90570-010',
                'pais' => 'Brasil'
            ],
            [
                'logradouro' => 'Avenida Beira Mar',
                'numero' => '1500',
                'complemento' => null,
                'bairro' => 'Meireles',
                'cidade' => 'Fortaleza',
                'estado' => 'CE',
                'cep' => '60165-121',
                'pais' => 'Brasil'
            ],
            [
                'logradouro' => 'Rua do Mercado',
                'numero' => '987',
                'complemento' => 'Sobreloja',
                'bairro' => 'Recife Antigo',
                'cidade' => 'Recife',
                'estado' => 'PE',
                'cep' => '50030-230',
                'pais' => 'Brasil'
            ],
            [
                'logradouro' => 'Alameda Santos',
                'numero' => '200',
                'complemento' => 'Conjunto 303',
                'bairro' => 'Jardim Paulista',
                'cidade' => 'São Paulo',
                'estado' => 'SP',
                'cep' => '01418-000',
                'pais' => 'Brasil'
            ]
        ];

        foreach ($enderecos as $endereco) {
            Endereco::create($endereco);
        }

        Endereco::factory()->count(20)->create();

        $this->command->info('Endereços criados com sucesso!');
        $this->command->info('Total: ' . Endereco::count() . ' endereços criados.');
    }
}