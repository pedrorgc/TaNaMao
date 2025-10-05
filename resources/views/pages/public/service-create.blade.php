@extends('layouts.app')

@section('title', 'Cadastro de Serviço')

@section('content')

<div class="container my-5" style="max-width:760px;">

    <a href="{{ url()->previous() }}" class="text-decoration-none">Voltar</a>
  <form action="#" method="POST">
    @csrf

      <h4 class="fw-bold text-center">DESCREVA TUDO SOBRE SEU SERVIÇO</h4>
    <div class="p-4 bg-body-secondary rounded-3 mb-3">
      <div class="mb-3 mt-3">
        <label class="form-label">Escolha o tipo de serviço que você quer anunciar</label>
        <input type="text" class="form-control" placeholder="Ex: encanador" name="tipo_servico">
      </div>
    </div>
 <div class="p-4 bg-body-secondary rounded-3 mb-3">
    <div class="mb-3">
        <label class="form-label">Precisamos do seu CNPJ ou CPF</label>
        <input type="text" class="form-control" placeholder="Digite o seu CNPJ/CPF" name="cpf_cnpj">
      </div>
</div>

    <div class="p-4 bg-body-secondary rounded-3 mb-3">
      <h6 class="fw-bold">Adicione um título e uma descrição</h6>
      <div class="mb-3">
        <label class="form-label">Título (obrigatório)</label>
        <input type="text" class="form-control" name="titulo" placeholder="ex: Encanador residencial - conserto de vazamentos">
      </div>
      <div class="mb-2">
        <label class="form-label">Descrição</label>
        <textarea class="form-control" rows="4" name="descricao" placeholder="Descreva seu serviço: o que inclui, área de atendimento, preço base, etc."></textarea>
      </div>
      <small class="text-danger">Não inclua dados de contato, email, telefone, endereços nem links nos campos de texto.</small>
    </div>

    <div class="p-4 bg-body-secondary rounded-3 mb-3">
      <h6 class="fw-bold">Qual endereço exato onde você oferece o serviço?</h6>
      <div class="mb-3">
        <label class="form-label">Endereço</label>
        <input type="text" class="form-control mb-2" name="endereco" placeholder="Av. Olindo de Miranda - Almenara, MG, 39900-000" value="Av Olindo de Miranda - Almenara, MG, 39900-000">
        <div class="ratio ratio-16x9 rounded-3 overflow-hidden border" style="background:#e9ecef;">
          <!-- mapa embed de exemplo -->
          <iframe
            src="https://www.google.com/maps?q=Av+Olindo+de+Miranda+Almenara+MG&output=embed"
            style="border:0; width:100%; height:100%;"
            allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>

    <div class="text-end mt-4">
      <button type="submit" class="btn btn-primary px-4">CONFIRMAR</button>
    </div>
  </form>

</div>

@endsection
