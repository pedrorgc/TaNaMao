@extends('layouts.app')

@section('title', 'Cadastro Necessário')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5 text-center">
                    <div class="mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-tools text-primary fs-3"></i>
                        </div>
                        <h2 class="fw-bold mb-3">Cadastro de Prestador Necessário</h2>
                        <p class="text-muted mb-4">
                            Para cadastrar serviços, você precisa primeiro completar seu cadastro como prestador.
                        </p>
                    </div>
                    
                    <div class="alert alert-info mb-4">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle me-3 fs-4"></i>
                            <div class="text-start">
                                <p class="mb-1 fw-semibold">O que você precisa fazer:</p>
                                <ul class="mb-0 ps-3">
                                    <li>Completar seu cadastro como prestador</li>
                                    <li>Fornecer CPF/CNPJ e telefone</li>
                                    <li>Cadastrar um endereço para atendimento</li>
                                    <li>Escolher categorias de serviço</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid gap-3">
                        <a href="{{ route('prestadores.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>
                            Completar Cadastro como Prestador
                        </a>
                        
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home me-2"></i>
                            Voltar para Home
                        </a>
                    </div>
                    
                    <div class="mt-4 pt-4 border-top">
                        <small class="text-muted">
                            <i class="fas fa-clock me-1"></i>
                            O processo leva apenas 5 minutos
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection