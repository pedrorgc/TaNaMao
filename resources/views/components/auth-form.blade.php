<form class="auth-form" method="POST" action="{{ route('register') }}">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <input type="hidden" name="role" id="role-input" value="cliente">

    @include('components.input-field', ['label' => 'Nome Completo', 'icon' => 'ph-user', 'type' => 'text', 'id' => 'nome', 'name' => 'name', 'placeholder' => 'Seu nome completo', 'value' => old('name')])

    @include('components.input-field', ['label' => 'E-mail', 'icon' => 'ph-envelope-simple', 'type' => 'email', 'id' => 'email', 'name' => 'email', 'placeholder' => 'seu@email.com', 'value' => old('email')])

    @include('components.input-field', ['label' => 'Telefone', 'icon' => 'ph-phone', 'type' => 'tel', 'id' => 'telefone', 'name' => 'telefone', 'placeholder' => '(99) 99999-9999', 'value' => old('telefone')])

    <div class="form-group" id="categoria-field" style="display:none;">
        <label for="categoria">Categoria</label>
        <div class="input-with-icon">
            <i class="ph ph-tag"></i>
            <select id="categoria" name="categoria">
                <option value="">Selecione</option>
                <option value="eletricista" {{ old('categoria') == 'eletricista' ? 'selected' : '' }}>Eletricista</option>
                <option value="encanador" {{ old('categoria') == 'encanador' ? 'selected' : '' }}>Encanador</option>
                <option value="pedreiro" {{ old('categoria') == 'pedreiro' ? 'selected' : '' }}>Pedreiro</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="endereco">Endereço</label>
        <button type="button" class="input-like-button" id="open-address-dialog">
            <i class="ph ph-map-pin"></i>
            <span id="endereco-display">Cidade, Estado</span>
        </button>
        <input type="hidden" name="endereco[logradouro]" id="endereco_logradouro">
        <input type="hidden" name="endereco[numero]" id="endereco_numero">
        <input type="hidden" name="endereco[complemento]" id="endereco_complemento">
        <input type="hidden" name="endereco[bairro]" id="endereco_bairro">
        <input type="hidden" name="endereco[cidade]" id="endereco_cidade">
        <input type="hidden" name="endereco[estado]" id="endereco_estado">
        <input type="hidden" name="endereco[cep]" id="endereco_cep">
        <input type="hidden" name="endereco[pais]" id="endereco_pais" value="Brasil">
    </div>

    @include('components.input-field', ['label' => 'Senha', 'icon' => 'ph-lock', 'type' => 'password', 'id' => 'senha', 'name' => 'password', 'placeholder' => 'Mínimo 8 caracteres'])
    @include('components.input-field', ['label' => 'Confirmar Senha', 'icon' => 'ph-lock', 'type' => 'password', 'id' => 'confirmar-senha', 'name' => 'password_confirmation', 'placeholder' => 'Confirme sua senha'])

    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <button type="button" class="btn btn-secondary">
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" class="google-icon">
        Continuar com Google
    </button>
</form>
