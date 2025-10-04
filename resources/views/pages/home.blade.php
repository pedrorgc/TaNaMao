@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
<div class="text-center">
    <h1>Categorias de Serviços</h1>

    <div class="row mt-4">
        <div class="col-md-3">
            @include('components.card', ['icon' => 'bi-wrench', 'title' => 'Encanador', 'slot' => 'Reparos hidráulicos'])
        </div>
        <div class="col-md-3">
            @include('components.card', ['icon' => 'bi-lightning-charge-fill', 'title' => 'Eletricista', 'slot' => 'Instalações elétricas'])
        </div>
        <div class="col-md-3">
            @include('components.card', ['icon' => 'bi-house-door-fill', 'title' => 'Diarista', 'slot' => 'Limpeza Residencial'])
        </div>
        <div class="col-md-3">
            @include('components.card', ['icon' => 'bi-gear-fill', 'title' => 'Mecânico', 'slot' => 'Manutenção Automotiva'])
        </div>
    </div>
</div>
<style>
    .card{
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
        padding: 20px;
    }
    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
</style>
@endsection
