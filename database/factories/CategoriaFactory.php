<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoriaFactory extends Factory
{
    protected $model = Categoria::class;

    public function definition(): array
    {
        $categorias = [
            'Eletricista' => ['icone' => 'bi-lightning-charge-fill', 'descricao' => 'Instalações e reparos elétricos'],
            'Encanador' => ['icone' => 'bi-wrench', 'descricao' => 'Reparos hidráulicos e encanamento'],
            'Pedreiro' => ['icone' => 'bi-hammer', 'descricao' => 'Construção e reformas em alvenaria'],
            'Pintor' => ['icone' => 'bi-brush-fill', 'descricao' => 'Pintura residencial e comercial'],
            'Marceneiro' => ['icone' => 'bi-tools', 'descricao' => 'Móveis sob medida e marcenaria'],
            'Jardineiro' => ['icone' => 'bi-flower1', 'descricao' => 'Paisagismo e manutenção de jardins'],
            'Limpeza' => ['icone' => 'bi-house-door-fill', 'descricao' => 'Serviços de limpeza residencial'],
            'Climatização' => ['icone' => 'bi-thermometer-half', 'descricao' => 'Instalação e manutenção de ar condicionado'],
            'Chaveiro' => ['icone' => 'bi-key-fill', 'descricao' => 'Serviços de chaveiro 24 horas'],
            'Vidraceiro' => ['icone' => 'bi-window', 'descricao' => 'Reparo e instalação de vidros'],
            'Mecânico' => ['icone' => 'bi-gear-fill', 'descricao' => 'Manutenção automotiva em geral'],
            'Conserto de Eletrodomésticos' => ['icone' => 'bi-plug-fill', 'descricao' => 'Reparo de eletrodomésticos'],
            'Técnico em Informática' => ['icone' => 'bi-laptop-fill', 'descricao' => 'Manutenção de computadores e redes'],
        ];

        $nome = $this->faker->randomElement(array_keys($categorias));
        $dados = $categorias[$nome];

        return [
            'nome' => $nome,
            'slug' => Str::slug($nome),
            'icone' => $dados['icone'],
            'descricao' => $dados['descricao'],
            'ordem' => $this->faker->numberBetween(1, 20),
            'ativo' => true,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function eletricista()
    {
        return $this->state(function (array $attributes) {
            return [
                'nome' => 'Eletricista',
                'slug' => 'eletricista',
                'icone' => 'bi-lightning-charge-fill',
                'descricao' => 'Instalações e reparos elétricos',
                'ordem' => 1,
            ];
        });
    }

    public function encanador()
    {
        return $this->state(function (array $attributes) {
            return [
                'nome' => 'Encanador',
                'slug' => 'encanador',
                'icone' => 'bi-wrench',
                'descricao' => 'Reparos hidráulicos e encanamento',
                'ordem' => 2,
            ];
        });
    }

    public function inativa()
    {
        return $this->state(function (array $attributes) {
            return [
                'ativo' => false,
            ];
        });
    }
}