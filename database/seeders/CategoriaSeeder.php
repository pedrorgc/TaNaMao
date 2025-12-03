<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    public function run()
    {
        $categorias = [
            [
                'nome' => 'Eletricista',
                'icone' => 'bi-lightning-charge-fill',
                'slug' => 'eletricista',
                'descricao' => 'Instalações e reparos elétricos',
                'ordem' => 1
            ],
            [
                'nome' => 'Encanador',
                'icone' => 'bi-wrench',
                'slug' => 'encanador',
                'descricao' => 'Reparos hidráulicos e encanamento',
                'ordem' => 2
            ],
            [
                'nome' => 'Pedreiro',
                'icone' => 'bi-hammer',
                'slug' => 'pedreiro',
                'descricao' => 'Construção e reformas em alvenaria',
                'ordem' => 3
            ],
            [
                'nome' => 'Pintor',
                'icone' => 'bi-brush-fill',
                'slug' => 'pintor',
                'descricao' => 'Pintura residencial e comercial',
                'ordem' => 4
            ],
            [
                'nome' => 'Marceneiro',
                'icone' => 'bi-tools',
                'slug' => 'marceneiro',
                'descricao' => 'Móveis sob medida e marcenaria',
                'ordem' => 5
            ],
            [
                'nome' => 'Jardineiro',
                'icone' => 'bi-flower1',
                'slug' => 'jardineiro',
                'descricao' => 'Paisagismo e manutenção de jardins',
                'ordem' => 6
            ],
            [
                'nome' => 'Limpeza',
                'icone' => 'bi-house-door-fill',
                'slug' => 'limpeza',
                'descricao' => 'Serviços de limpeza residencial',
                'ordem' => 7
            ],
            [
                'nome' => 'Climatização',
                'icone' => 'bi-thermometer-half',
                'slug' => 'climatizacao',
                'descricao' => 'Instalação e manutenção de ar condicionado',
                'ordem' => 8
            ],
            [
                'nome' => 'Chaveiro',
                'icone' => 'bi-key-fill',
                'slug' => 'chaveiro',
                'descricao' => 'Serviços de chaveiro 24 horas',
                'ordem' => 9
            ],
            [
                'nome' => 'Vidraceiro',
                'icone' => 'bi-window',
                'slug' => 'vidraceiro',
                'descricao' => 'Reparo e instalação de vidros',
                'ordem' => 10
            ],
            [
                'nome' => 'Mecânico',
                'icone' => 'bi-gear-fill',
                'slug' => 'mecanico',
                'descricao' => 'Manutenção automotiva em geral',
                'ordem' => 11
            ],
            [
                'nome' => 'Conserto de Eletrodomésticos',
                'icone' => 'bi-plug-fill',
                'slug' => 'conserto-eletrodomesticos',
                'descricao' => 'Reparo de eletrodomésticos',
                'ordem' => 12
            ],
            [
                'nome' => 'Técnico em Informática',
                'icone' => 'bi-laptop-fill',
                'slug' => 'tecnico-informatica',
                'descricao' => 'Manutenção de computadores e redes',
                'ordem' => 13
            ],
            [
                'nome' => 'Outros',
                'icone' => 'bi-briefcase-fill',
                'slug' => 'outros',
                'descricao' => 'Demais serviços especializados',
                'ordem' => 14
            ],
        ];

        foreach ($categorias as $categoria) {
            $slug = Str::slug($categoria['nome']);

            Categoria::updateOrCreate(
                ['nome' => $categoria['nome']],
                array_merge($categoria, [
                    'slug' => $slug,
                    'ativo' => true
                ])
            );
        }
    }
}
