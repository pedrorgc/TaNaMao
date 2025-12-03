<?php

namespace Database\Factories;

use App\Models\Endereco;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnderecoFactory extends Factory
{
    protected $model = Endereco::class;

    public function definition(): array
    {
        $cidades = [
            ['São Paulo', 'SP'],
            ['Rio de Janeiro', 'RJ'],
            ['Belo Horizonte', 'MG'],
            ['Curitiba', 'PR'],
            ['Porto Alegre', 'RS'],
            ['Salvador', 'BA'],
            ['Recife', 'PE'],
            ['Fortaleza', 'CE'],
            ['Brasília', 'DF'],
            ['Goiânia', 'GO'],
        ];

        $cidade = $this->faker->randomElement($cidades);
        
        return [
            'logradouro' => $this->faker->streetName(),
            'numero' => (string) rand(1, 9999),
            'complemento' => rand(0, 1) ? $this->gerarComplemento() : null,
            'bairro' => $this->gerarBairro(),
            'cidade' => $cidade[0],
            'estado' => $cidade[1],
            'cep' => $this->gerarCep(),
            'pais' => 'Brasil',
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    private function gerarComplemento(): string
    {
        $complementos = [
            'Ap ' . rand(101, 999),
            'Sala ' . rand(1, 50),
            'Bloco ' . chr(rand(65, 70)) . ' Apt ' . rand(101, 999),
            'Loja ' . rand(1, 100),
            'Casa ' . rand(1, 10),
            'Fundos',
            'Sobreloja',
            'Conjunto ' . rand(1, 20),
        ];
        
        return $complementos[array_rand($complementos)];
    }

    private function gerarBairro(): string
    {
        $bairros = [
            'Centro',
            'Jardins',
            'Vila Nova',
            'Bela Vista',
            'Copacabana',
            'Ipanema',
            'Moema',
            'Pinheiros',
            'Tatuapé',
            'Santana',
        ];
        
        return $bairros[array_rand($bairros)];
    }

    private function gerarCep(): string
    {
        return sprintf('%05d-%03d', rand(10000, 99999), rand(100, 999));
    }

    public function saoPaulo()
    {
        return $this->state(function (array $attributes) {
            return [
                'cidade' => 'São Paulo',
                'estado' => 'SP',
                'cep' => $this->gerarCep(),
            ];
        });
    }

    public function rioDeJaneiro()
    {
        return $this->state(function (array $attributes) {
            return [
                'cidade' => 'Rio de Janeiro',
                'estado' => 'RJ',
                'cep' => $this->gerarCep(),
            ];
        });
    }
}