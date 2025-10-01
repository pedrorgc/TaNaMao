@extends('layouts.app')

@section('title', 'Página Inicial')

@section('content')
<div class="text-center">
    <h1>Bem-vindo ao Projeto Laravel + Bootstrap!</h1>
    <p>Esta é a página inicial do sistema modular.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            @include('components.card', ['title' => 'Funcionalidade 1', 'slot' => 'Descrição da funcionalidade 1'])
        </div>
        <div class="col-md-4">
            @include('components.card', ['title' => 'Funcionalidade 2', 'slot' => 'Descrição da funcionalidade 2'])
        </div>
        <div class="col-md-4">
            @include('components.card', ['title' => 'Funcionalidade 3', 'slot' => 'Descrição da funcionalidade 3'])
        </div>
    </div>
</div>
@endsection
