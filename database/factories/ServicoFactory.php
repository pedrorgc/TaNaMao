<?php

namespace Database\Factories;

use App\Models\Servico;
use App\Models\Prestador;
use App\Models\Categoria;
use App\Models\Endereco;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicoFactory extends Factory
{
    protected $model = Servico::class;

    public function definition(): array
    {
        $cidades = ['São Paulo', 'Rio de Janeiro', 'Belo Horizonte', 'Curitiba', 'Porto Alegre'];
        $estados = ['SP', 'RJ', 'MG', 'PR', 'RS'];
        
        return [
            'prestador_id' => Prestador::factory(),
            'categoria_id' => Categoria::factory(),
            'titulo' => $this->faker->sentence(3),
            'slug' => $this->faker->unique()->slug(3),
            'descricao' => $this->faker->paragraph(3),
            'tipo_servico' => $this->faker->randomElement(['instalacao', 'reparo', 'manutencao', 'consulta']),
            
            'cpf_cnpj_servico' => rand(0, 1) ? $this->gerarDocumento() : null,
            'telefone_servico' => rand(0, 1) ? $this->gerarTelefone() : null,
            
            'valor_hora' => rand(0, 1) ? round(rand(30, 200) + (rand(0, 99) / 100), 2) : null,
            'valor_fixo' => rand(0, 1) ? round(rand(100, 5000) + (rand(0, 99) / 100), 2) : null,
            'tipo_valor' => $this->faker->randomElement(['hora', 'fixo', 'orcamento']),
            
            'status' => $this->faker->randomElement(['ativo', 'ativo', 'ativo', 'pendente', 'rascunho']),
            'verificado' => $this->faker->boolean(70),
            
            'endereco_servico_id' => rand(0, 1) ? Endereco::factory() : null,
            'cidade_servico' => rand(0, 1) ? $cidades[array_rand($cidades)] : null,
            'estado_servico' => rand(0, 1) ? $estados[array_rand($estados)] : null,
            'cep_servico' => rand(0, 1) ? $this->gerarCep() : null,
            
            'latitude' => rand(0, 1) ? round(-23.5 + (rand(-500, 500) / 1000), 8) : null,
            'longitude' => rand(0, 1) ? round(-46.6 + (rand(-500, 500) / 1000), 8) : null,
            
            'visualizacoes' => $this->faker->numberBetween(0, 10000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Servico $servico) {
        });
    }

    public function ativo()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'ativo',
                'verificado' => true,
            ];
        });
    }

    public function rascunho()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'rascunho',
                'verificado' => false,
            ];
        });
    }

    private function gerarDocumento(): string
    {
        return rand(0, 1) ? $this->gerarCpf() : $this->gerarCnpj();
    }

    private function gerarCpf(): string
    {
        return sprintf('%03d.%03d.%03d-%02d', 
            rand(100, 999), rand(100, 999), rand(100, 999), rand(10, 99)
        );
    }

    private function gerarCnpj(): string
    {
        return sprintf('%02d.%03d.%03d/%04d-%02d', 
            rand(10, 99), rand(100, 999), rand(100, 999), rand(1000, 9999), rand(10, 99)
        );
    }

    private function gerarTelefone(): string
    {
        $ddds = ['11', '21', '31', '41', '51'];
        $ddd = $ddds[array_rand($ddds)];
        
        return "($ddd) 9" . rand(8000, 9999) . '-' . rand(1000, 9999);
    }

    private function gerarCep(): string
    {
        return sprintf('%05d-%03d', rand(10000, 99999), rand(100, 999));
    }
}