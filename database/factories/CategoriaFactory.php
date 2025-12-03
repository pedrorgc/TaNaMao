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
        $nomesCategorias = [
            'Eletricista', 'Encanador', 'Pedreiro', 'Pintor', 'Marceneiro',
            'Jardineiro', 'Limpeza', 'Climatização', 'Chaveiro', 'Vidraceiro',
            'Mecânico', 'Conserto de Eletrodomésticos', 'Técnico em Informática', 'Outros'
        ];

        $nome = $this->faker->randomElement($nomesCategorias);
        $slug = Str::slug($nome);
        
        $categoriaExistente = Categoria::where('nome', $nome)->orWhere('slug', $slug)->first();
        
        if ($categoriaExistente) {
            return [
                'nome' => $categoriaExistente->nome,
                'slug' => $categoriaExistente->slug,
                'icone' => $categoriaExistente->icone,
                'descricao' => $categoriaExistente->descricao,
                'ordem' => $categoriaExistente->ordem,
                'ativo' => $categoriaExistente->ativo,
                'created_at' => $categoriaExistente->created_at,
                'updated_at' => $categoriaExistente->updated_at,
            ];
        }

        $icones = [
            'Eletricista' => 'bi-lightning-charge-fill',
            'Encanador' => 'bi-wrench',
            'Pedreiro' => 'bi-hammer',
            'Pintor' => 'bi-brush-fill',
            'Marceneiro' => 'bi-tools',
            'Jardineiro' => 'bi-flower1',
            'Limpeza' => 'bi-house-door-fill',
            'Climatização' => 'bi-thermometer-half',
            'Chaveiro' => 'bi-key-fill',
            'Vidraceiro' => 'bi-window',
            'Mecânico' => 'bi-gear-fill',
            'Conserto de Eletrodomésticos' => 'bi-plug-fill',
            'Técnico em Informática' => 'bi-laptop-fill',
            'Outros' => 'bi-briefcase-fill'
        ];

        $descricoes = [
            'Eletricista' => 'Instalações e reparos elétricos',
            'Encanador' => 'Reparos hidráulicos e encanamento',
            'Pedreiro' => 'Construção e reformas em alvenaria',
            'Pintor' => 'Pintura residencial e comercial',
            'Marceneiro' => 'Móveis sob medida e marcenaria',
            'Jardineiro' => 'Paisagismo e manutenção de jardins',
            'Limpeza' => 'Serviços de limpeza residencial',
            'Climatização' => 'Instalação e manutenção de ar condicionado',
            'Chaveiro' => 'Serviços de chaveiro 24 horas',
            'Vidraceiro' => 'Reparo e instalação de vidros',
            'Mecânico' => 'Manutenção automotiva em geral',
            'Conserto de Eletrodomésticos' => 'Reparo de eletrodomésticos',
            'Técnico em Informática' => 'Manutenção de computadores e redes',
            'Outros' => 'Demais serviços especializados'
        ];

        return [
            'nome' => $nome,
            'slug' => $slug,
            'icone' => $icones[$nome] ?? 'bi-briefcase-fill',
            'descricao' => $descricoes[$nome] ?? 'Serviços especializados',
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