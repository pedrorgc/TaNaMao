<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{


    public function run()
    {
        $categorias = [
            'Eletricista', 'Encanador', 'Pedreiro', 'Pintor',
            'Marceneiro', 'Jardineiro', 'Limpeza', 'Climatização',
            'Chaveiro', 'Vidraceiro', 'Mecânico',
            'Conserto de Eletrodomésticos', 'Técnico em Informática', 'Outros'
        ];

        foreach ($categorias as $c) {
            Categoria::create(['nome' => $c]);
        }
    }
}
