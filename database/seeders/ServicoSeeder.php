<?php

namespace Database\Seeders;

use App\Models\Servico;
use App\Models\Prestador;
use App\Models\Categoria;
use App\Models\Endereco;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Database\Factories\ServicoFactory;

class ServicoSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Criando serviços...');

        if (Categoria::count() === 0) {
            $this->call(CategoriaSeeder::class);
        }

        $prestadores = Prestador::with('user')->get();
        $categorias = Categoria::all();

        if ($prestadores->isEmpty()) {
            $this->command->error('Não há prestadores cadastrados!');
            return;
        }

        if ($categorias->isEmpty()) {
            $this->command->error('Não há categorias cadastradas!');
            return;
        }

        $this->criarServicosComFactory($prestadores, $categorias);

        $this->criarServicosDemonstracao($prestadores, $categorias);

        $this->command->info('Serviços criados com sucesso!');
        $this->command->info('Total: ' . Servico::count() . ' serviços criados.');
    }

    private function criarServicosComFactory($prestadores, $categorias): void
    {
        $this->command->info('Criando serviços usando factory...');

        $totalServicos = 0;
        
        foreach ($prestadores as $prestador) {
            $numServicos = rand(1, 4);
            
            for ($i = 0; $i < $numServicos; $i++) {
                $categoria = $categorias->random();
                
                $factory = ServicoFactory::new();
                
                if ($i === 0) {
                    $factory = $factory->ativo();
                } else {
                    if (rand(1, 10) <= 8) {
                        $factory = $factory->ativo();
                    }
                }
                
                $titulo = $this->gerarTituloParaCategoria($categoria->slug);
                $slug = Str::slug($titulo) . '-' . $prestador->id . '-' . $i . '-' . Str::random(4);
                
                while (Servico::where('slug', $slug)->exists()) {
                    $slug = Str::slug($titulo) . '-' . $prestador->id . '-' . $i . '-' . Str::random(4);
                }
                
                $factory->create([
                    'prestador_id' => $prestador->id,
                    'categoria_id' => $categoria->id,
                    'titulo' => $titulo,
                    'slug' => $slug,
                ]);
                
                $totalServicos++;
            }
        }
        
        $this->command->info("{$totalServicos} serviços criados com factory.");
    }

    private function gerarTituloParaCategoria(string $categoriaSlug): string
    {
        $titulos = [
            'eletricista' => [
                'Instalação de Chuveiro Elétrico',
                'Reparo de Tomadas e Interruptores',
                'Instalação de Luminárias',
                'Manutenção de Quadro de Luz',
                'Passagem de Fiação Nova'
            ],
            'encanador' => [
                'Desentupimento de Pia',
                'Reparo de Vazamentos',
                'Instalação de Torneira',
                'Substituição de Vaso Sanitário',
                'Limpeza de Caixa d\'Água'
            ],
            'pedreiro' => [
                'Assentamento de Piso',
                'Reboco e Chapisco',
                'Construção de Muro',
                'Reparo em Alvenaria',
                'Instalação de Azulejo'
            ],
            'pintor' => [
                'Pintura de Apartamento',
                'Pintura de Fachada',
                'Textura em Parede',
                'Pintura de Móveis',
                'Impermeabilização'
            ],
            'marceneiro' => [
                'Móveis Sob Medida para Cozinha',
                'Guarda-Roupas Planejado',
                'Escrivaninha para Home Office',
                'Prateleiras e Nichos',
                'Restauração de Móveis'
            ],
            'jardineiro' => [
                'Paisagismo Residencial',
                'Manutenção de Jardim',
                'Podagem de Árvores',
                'Instalação de Grama',
                'Sistema de Irrigação'
            ],
            'limpeza' => [
                'Limpeza Residencial Completa',
                'Limpeza Pós-Obra',
                'Limpeza de Estofados',
                'Limpeza de Vidros',
                'Organização de Ambientes'
            ],
            'tecnico-informatica' => [
                'Formatação e Instalação de Sistema',
                'Manutenção de Computadores',
                'Configuração de Redes',
                'Remoção de Vírus',
                'Backup de Dados'
            ],
            'mecanico' => [
                'Troca de Óleo e Filtros',
                'Manutenção Preventiva',
                'Alinhamento e Balanceamento',
                'Reparo de Freios',
                'Troca de Pneus'
            ],
            'climatizacao' => [
                'Instalação de Ar Condicionado',
                'Manutenção Preventiva de Ar',
                'Limpeza de Split',
                'Recarga de Gás',
                'Instalação de Ventilação'
            ],
            'chaveiro' => [
                'Cópia de Chaves',
                'Abertura de Portas',
                'Instalação de Fechaduras',
                'Reparo de Cadeados',
                'Sistema de Segurança'
            ],
            'vidraceiro' => [
                'Reparo de Vidros Quebrados',
                'Instalação de Box para Banheiro',
                'Espelhos sob Medida',
                'Vidro Temperado',
                'Janelas de Vidro'
            ],
            'conserto-eletrodomesticos' => [
                'Reparo de Geladeira',
                'Conserto de Máquina de Lavar',
                'Manutenção de Fogão',
                'Reparo de Micro-ondas',
                'Conserto de Ar Condicionado'
            ],
        ];

        return isset($titulos[$categoriaSlug]) 
            ? $titulos[$categoriaSlug][array_rand($titulos[$categoriaSlug])]
            : 'Serviço Profissional de Qualidade';
    }

    private function criarServicosDemonstracao($prestadores, $categorias): void
    {
        $this->command->info('Criando serviços de demonstração...');

        // Verifica se temos as categorias necessárias
        $categoriaEletricista = $categorias->where('slug', 'eletricista')->first();
        $categoriaEncanador = $categorias->where('slug', 'encanador')->first();
        
        if (!$categoriaEletricista || !$categoriaEncanador) {
            $this->command->warn('Categorias de demonstração não encontradas. Pulando criação de serviços demo.');
            return;
        }

        $servicosDemonstracao = [
            [
                'prestador_id' => $prestadores->first()->id,
                'categoria_id' => $categoriaEletricista->id,
                'titulo' => 'Instalação Completa de Quadro de Luz',
                'descricao' => 'Instalação profissional de quadro de luz residencial com disjuntores, DR e padrão de entrada. Garantia de 1 ano no serviço prestado.',
                'tipo_servico' => 'instalacao',
                'tipo_valor' => 'fixo',
                'valor_fixo' => 850.00,
                'status' => 'ativo',
                'verificado' => true,
                'cidade_servico' => 'São Paulo',
                'estado_servico' => 'SP',
                'visualizacoes' => rand(500, 5000),
            ],
        ];

        // Adiciona segundo serviço de demonstração se houver pelo menos 2 prestadores
        if ($prestadores->count() > 1) {
            $servicosDemonstracao[] = [
                'prestador_id' => $prestadores->get(1)->id,
                'categoria_id' => $categoriaEncanador->id,
                'titulo' => 'Desentupimento Urgente de Esgoto',
                'descricao' => 'Serviço urgente de desentupimento de esgoto residencial e comercial. Atendimento 24 horas com equipamentos modernos.',
                'tipo_servico' => 'reparo',
                'tipo_valor' => 'fixo',
                'valor_fixo' => 350.00,
                'status' => 'ativo',
                'verificado' => true,
                'cidade_servico' => 'Rio de Janeiro',
                'estado_servico' => 'RJ',
                'visualizacoes' => rand(300, 3000),
            ];
        }

        foreach ($servicosDemonstracao as $servicoData) {
            // Verifica se já existe um serviço similar
            $existe = Servico::where('titulo', $servicoData['titulo'])
                ->where('prestador_id', $servicoData['prestador_id'])
                ->exists();
            
            if (!$existe) {
                $slug = Str::slug($servicoData['titulo']) . '-demo-' . Str::random(5);
                
                // Verifica se o slug já existe
                while (Servico::where('slug', $slug)->exists()) {
                    $slug = Str::slug($servicoData['titulo']) . '-demo-' . Str::random(5);
                }
                
                ServicoFactory::new()->create(array_merge($servicoData, [
                    'slug' => $slug,
                    'cpf_cnpj_servico' => null,
                    'telefone_servico' => $this->gerarTelefone(),
                    'valor_hora' => null,
                    'cep_servico' => $this->gerarCep(),
                    'latitude' => $this->getLatitude(),
                    'longitude' => $this->getLongitude(),
                    'created_at' => now()->subDays(rand(10, 100)),
                    'updated_at' => now()->subDays(rand(0, 10)),
                ]));
            }
        }
    }

    private function gerarTelefone(): string
    {
        $ddd = ['11', '21', '31', '41', '51'][array_rand(['11', '21', '31', '41', '51'])];
        return "({$ddd}) 9" . rand(8000, 9999) . '-' . rand(1000, 9999);
    }

    private function gerarCep(): string
    {
        return sprintf('%05d-%03d', rand(10000, 99999), rand(100, 999));
    }

    private function getLatitude(): float
    {
        return -23.5 + (rand(-500, 500) / 1000);
    }

    private function getLongitude(): float
    {
        return -46.6 + (rand(-500, 500) / 1000);
    }
}