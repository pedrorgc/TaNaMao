@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Cadastrar Novo Serviço</h4>
                    <small class="text-light">Dados do seu cadastro serão usados automaticamente</small>
                </div>
                
                <div class="card-body">
                    @if($dadosPrestador['progresso'] < 100)
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Seu cadastro está {{ number_format($dadosPrestador['progresso'], 0) }}% completo. 
                        Complete-o para uma melhor experiência.
                    </div>
                    @endif
                    
                    <form action="{{ route('servicos.store') }}" method="POST">
                        @csrf
                        
                        <h5 class="border-bottom pb-2 mb-3">Informações do Serviço</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Título do Serviço *</label>
                                <input type="text" name="titulo" class="form-control" 
                                       placeholder="Ex: Encanador Residencial Profissional" required>
                                <div class="form-text">Nome que aparecerá nos anúncios</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tipo de Serviço *</label>
                                <input type="text" name="tipo_servico" class="form-control" 
                                       placeholder="Ex: Encanador, Eletricista, Pedreiro" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Categoria Principal *</label>
                            <select name="categoria_id" class="form-control" required>
                                <option value="">Selecione uma categoria</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ ($categoriaPredefinida && $categoria->id == $categoriaPredefinida->id) ? 'selected' : '' }}>
                                        {{ $categoria->nome }}
                                        @if($categoriaPredefinida && $categoria->id == $categoriaPredefinida->id)
                                            <span class="text-success">(sugerida do seu cadastro)</span>
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                            @if($categoriaPredefinida)
                            <div class="form-text text-success">
                                <i class="fas fa-check-circle"></i> Sugerimos: <strong>{{ $categoriaPredefinida->nome }}</strong>
                            </div>
                            @endif
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Descrição Detalhada *</label>
                            <textarea name="descricao" class="form-control" rows="5" 
                                      placeholder="Descreva seu serviço em detalhes. Inclua experiência, áreas de atuação, materiais utilizados, garantias, etc." 
                                      required></textarea>
                            <div class="form-text">
                                <i class="fas fa-exclamation-triangle text-warning"></i>
                                Não inclua telefones, emails ou links na descrição.
                            </div>
                        </div>
                        
                        <h5 class="border-bottom pb-2 mb-3 mt-4">Dados para Contato</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    CPF/CNPJ 
                                    @if($dadosPrestador['tem_documento'])
                                        <span class="text-success">✓</span>
                                    @endif
                                </label>
                                <div class="input-group">
                                    <input type="text" name="cpf_cnpj_servico" 
                                           class="form-control @if($dadosPrestador['tem_documento']) border-success @endif"
                                           value="{{ $dadosPrestador['cpf_cnpj'] }}"
                                           placeholder="CPF ou CNPJ">
                                    @if($dadosPrestador['tem_documento'])
                                    <span class="input-group-text bg-success text-white">
                                        <i class="fas fa-check"></i> Do cadastro
                                    </span>
                                    @endif
                                </div>
                                <div class="form-text">Deixe em branco para usar: <strong>{{ $dadosPrestador['cpf_cnpj'] ?: 'Não cadastrado' }}</strong></div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Telefone para Contato
                                    @if($dadosPrestador['tem_telefone'])
                                        <span class="text-success">✓</span>
                                    @endif
                                </label>
                                <div class="input-group">
                                    <input type="text" name="telefone_servico" 
                                           class="form-control @if($dadosPrestador['tem_telefone']) border-success @endif"
                                           value="{{ $dadosPrestador['telefone'] }}"
                                           placeholder="(11) 99999-9999">
                                    @if($dadosPrestador['tem_telefone'])
                                    <span class="input-group-text bg-success text-white">
                                        <i class="fas fa-check"></i> Do cadastro
                                    </span>
                                    @endif
                                </div>
                                <div class="form-text">Deixe em branco para usar: <strong>{{ $dadosPrestador['telefone'] ?: 'Não cadastrado' }}</strong></div>
                            </div>
                        </div>
                        
                        <h5 class="border-bottom pb-2 mb-3 mt-4">Localização do Serviço</h5>
                        
                        @if($dadosPrestador['tem_endereco_completo'])
                        <div class="alert alert-success">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="usar_endereco_cadastro" id="usar_endereco_cadastro" value="1" checked>
                                <label class="form-check-label" for="usar_endereco_cadastro">
                                    <strong>Usar endereço do meu cadastro</strong>
                                    <div class="text-muted">
                                        {{ $dadosPrestador['endereco'] }}
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div id="endereco_alternativo" style="display: none;">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                Preencha abaixo se deseja usar um endereço diferente
                            </div>
                        @endif
                        
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">CEP</label>
                                    <input type="text" name="cep_servico" class="form-control cep"
                                           value="{{ $dadosPrestador['cep'] }}"
                                           placeholder="00000-000"
                                           {{ $dadosPrestador['tem_endereco_completo'] ? 'disabled' : '' }}>
                                </div>
                                
                                <div class="col-md-8 mb-3">
                                    <label class="form-label">Endereço</label>
                                    <input type="text" name="endereco_completo" class="form-control"
                                           value="{{ $dadosPrestador['logradouro'] ? $dadosPrestador['logradouro'] . ', ' . $dadosPrestador['numero'] : '' }}"
                                           placeholder="Rua, número, complemento"
                                           {{ $dadosPrestador['tem_endereco_completo'] ? 'disabled' : '' }}>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Cidade</label>
                                    <input type="text" name="cidade_servico" class="form-control"
                                           value="{{ $dadosPrestador['cidade'] }}"
                                           placeholder="Cidade"
                                           {{ $dadosPrestador['tem_endereco_completo'] ? 'disabled' : '' }}>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Estado</label>
                                    <select name="estado_servico" class="form-control"
                                            {{ $dadosPrestador['tem_endereco_completo'] ? 'disabled' : '' }}>
                                        <option value="">Selecione</option>
                                        <option value="AC" {{ $dadosPrestador['estado'] == 'AC' ? 'selected' : '' }}>Acre</option>
                                        <option value="AL" {{ $dadosPrestador['estado'] == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                        <option value="AP" {{ $dadosPrestador['estado'] == 'AP' ? 'selected' : '' }}>Amapá</option>
                                        <option value="MG" {{ $dadosPrestador['estado'] == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                        <option value="AM" {{ $dadosPrestador['estado'] == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                        <option value="SP" {{ $dadosPrestador['estado'] == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                        <option value="RJ" {{ $dadosPrestador['estado'] == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                        <option value="BA" {{ $dadosPrestador['estado'] == 'BA' ? 'selected' : '' }}>Bahia</option>
                                        <option value="ES" {{ $dadosPrestador['estado'] == 'ES' ? 'selected' : '' }}>Espiríto Santo</option>
                                        <option value="RS" {{ $dadosPrestador['estado'] == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                        <option value="TO" {{ $dadosPrestador['estado'] == 'TO' ? 'selected' : '' }}>Tocantins</option>
                                        <option value="PE" {{ $dadosPrestador['estado'] == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                    </select>
                                </div>
                            </div>
                        
                        @if($dadosPrestador['tem_endereco_completo'])
                        </div>
                        @endif
                        
                        <h5 class="border-bottom pb-2 mb-3 mt-4">Preços</h5>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Tipo de Valor *</label>
                                <select name="tipo_valor" class="form-control" required>
                                    <option value="orcamento" selected>Orçamento sob consulta</option>
                                    <option value="hora">Por hora</option>
                                    <option value="fixo">Valor fixo</option>
                                </select>
                            </div>
                            
                            <div class="col-md-4 mb-3" id="campo_valor_hora" style="display: none;">
                                <label class="form-label">Valor por Hora (R$)</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="number" name="valor_hora" class="form-control" 
                                           step="0.01" min="0" placeholder="0,00">
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3" id="campo_valor_fixo" style="display: none;">
                                <label class="form-label">Valor Fixo (R$)</label>
                                <div class="input-group">
                                    <span class="input-group-text">R$</span>
                                    <input type="number" name="valor_fixo" class="form-control" 
                                           step="0.01" min="0" placeholder="0,00">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Voltar
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-check"></i> Publicar Serviço
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para mostrar/ocultar campos de endereço e preço -->
<script>
document.addEventListener('DOMContentLoaded', function() {

    const usarEnderecoCheckbox = document.getElementById('usar_endereco_cadastro');
    const enderecoAlternativo = document.getElementById('endereco_alternativo');
    
    if (usarEnderecoCheckbox && enderecoAlternativo) {
        usarEnderecoCheckbox.addEventListener('change', function() {
            if (this.checked) {
                enderecoAlternativo.style.display = 'none';
                // desabilita campos do endereço alternativo
                enderecoAlternativo.querySelectorAll('input, select').forEach(el => {
                    el.disabled = true;
                });
            } else {
                enderecoAlternativo.style.display = 'block';
                // habilita campos do endereço alternativo
                enderecoAlternativo.querySelectorAll('input, select').forEach(el => {
                    el.disabled = false;
                });
            }
        });
        
        // inicializa estado
        if (usarEnderecoCheckbox.checked) {
            enderecoAlternativo.querySelectorAll('input, select').forEach(el => {
                el.disabled = true;
            });
        }
    }
    
    // controle dos campos de preço
    const tipoValorSelect = document.querySelector('select[name="tipo_valor"]');
    const campoValorHora = document.getElementById('campo_valor_hora');
    const campoValorFixo = document.getElementById('campo_valor_fixo');
    
    if (tipoValorSelect) {
        tipoValorSelect.addEventListener('change', function() {
            if (this.value === 'hora') {
                campoValorHora.style.display = 'block';
                campoValorFixo.style.display = 'none';
                campoValorHora.querySelector('input').required = true;
                campoValorFixo.querySelector('input').required = false;
            } else if (this.value === 'fixo') {
                campoValorHora.style.display = 'none';
                campoValorFixo.style.display = 'block';
                campoValorHora.querySelector('input').required = false;
                campoValorFixo.querySelector('input').required = true;
            } else {
                campoValorHora.style.display = 'none';
                campoValorFixo.style.display = 'none';
                campoValorHora.querySelector('input').required = false;
                campoValorFixo.querySelector('input').required = false;
            }
        });
        
        tipoValorSelect.dispatchEvent(new Event('change'));
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const cepInput = document.querySelector('input[name="cep_servico"]');
    if (cepInput) {
        cepInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.replace(/^(\d{5})(\d)/, '$1-$2');
            }
            e.target.value = value.substring(0, 9);
        });
    }
});
</script>

<style>
    .border-success {
        border-color: #28a745 !important;
    }
    
    #endereco_alternativo {
        transition: all 0.3s ease;
    }
</style>
@endsection