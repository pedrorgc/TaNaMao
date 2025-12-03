<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servico;
use App\Models\Prestador;
use App\Models\Categoria;

class ServicoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = Categoria::all();
        $prestadores = Prestador::all();
        
        foreach ($prestadores as $prestador) {
            Servico::create([
                'prestador_id' => $prestador->id,
                'categoria_id' => $categorias->random()->id,
                'titulo' => 'Serviço de ' . $prestador->user->name,
                'descricao' => 'Descrição detalhada do serviço oferecido.',
                'tipo_servico' => 'Serviço profissional',
                'cpf_cnpj' => '12345678900',
                'valor_hora' => rand(50, 200),
                'valor_fixo' => rand(100, 1000),
                'tipo_valor' => ['hora', 'fixo', 'orcamento'][rand(0, 2)],
                'status' => 'ativo',
                'verificado' => true,
                'endereco' => json_encode(['logradouro' => 'Rua Exemplo, 123']),
                'cidade' => 'São Paulo',
                'estado' => 'SP',
                'cep' => '01001000',
                'visualizacoes' => rand(0, 1000),
            ]);
        }
    }
}