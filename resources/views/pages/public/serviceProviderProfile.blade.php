@extends('layouts.app')

@section('title', 'Portfólio do Prestador')

@section('content')
<section class="container py-5">
    {{-- Voltar --}}
    <div class="mb-4 d-flex align-items-center">
        <a href="{{ url()->previous() }}" class="text-primary d-flex align-items-center gap-1 fw-semibold">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <span class="mx-auto fw-semibold text-muted">Portfólio do Prestador</span>
    </div>

    <div class="row g-4">
        {{-- Coluna principal --}}
        <div class="col-lg-8">
            {{-- Cabeçalho do prestador --}}
            @include('components.card-pessoa', [
                'nome' => 'João Silva',
                'profissao' => 'Encanador',
                'avaliacao' => 4.8,
                'avaliacoes' => 127,
                'cidade' => 'Almenara, MG',
                'verificado' => true,
                'valor' => 'R$ 80 - 120/h'
            ])

            {{-- Sobre --}}
            <x-bloco-sobre 
                descricao="Encanador com mais de 10 anos de experiência em reparos residenciais e comerciais. Especialista em instalações, manutenção preventiva e emergências 24h."
                trabalhos="105"
                avaliacao="4.8"
                resposta="<2h"
                desde="2023"
            />

            {{-- Serviços --}}
            <x-card-service 
                :servicos="[
                    'Reparos em torneiras e chuveiros',
                    'Desentupimento de pias e vasos',
                    'Instalações de aquecedores',
                    'Reparos de vazamentos'
                ]"
            />

            {{-- Portfólio de trabalhos --}}
            <x-bloco-portfolio 
                :imagens="[
                    ['url' => '/img/portfolio1.jpg', 'descricao' => 'Instalação de encanamento'],
                    ['url' => '/img/portfolio2.jpg', 'descricao' => 'Reparo de vazamento'],
                    ['url' => '/img/portfolio3.jpg', 'descricao' => 'Substituição de torneira'],
                    ['url' => '/img/portfolio4.jpg', 'descricao' => 'Instalação de chuveiro']
                ]"
            />

            {{-- Avaliações --}}
            <x-bloco-avaliacao 
                :avaliacoes="[
                    ['autor' => 'Maria S.', 'nota' => 5, 'servico' => 'Reparo de encanamento', 'data' => '18/04/2024', 'comentario' => 'Excelente profissional! Resolveu rápido e com preço justo.'],
                    ['autor' => 'Carlos M.', 'nota' => 5, 'servico' => 'Instalação de torneira', 'data' => '17/03/2024', 'comentario' => 'Pontual e competente. Recomendo!']
                ]"
            />
        </div>

        {{-- Coluna lateral --}}
        <div class="col-lg-4">
            <x-card-contato />
            <x-card-horarios />
            <x-card-localizacao />
            <x-card-certificados />
        </div>
    </div>
</section>
@endsection
