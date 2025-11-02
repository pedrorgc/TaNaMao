<form class="auth-form" method="POST" action="{{ route('register.perform') }}">
    @csrf

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <input type="hidden" name="account_type" id="account_type" value="cliente">
    @include('components.input-field', ['label' => 'Nome Completo', 'icon' => 'ph-user', 'type' => 'text', 'id' => 'name', 'name' => 'name', 'placeholder' => 'Seu nome completo', 'required' => true])

    @include('components.input-field', ['label' => 'E-mail', 'icon' => 'ph-envelope-simple', 'type' => 'email', 'id' => 'email', 'name' => 'email', 'placeholder' => 'seu@email.com', 'required' => true])

    @include('components.input-field', ['label' => 'Telefone', 'icon' => 'ph-phone', 'type' => 'tel', 'id' => 'telefone', 'name' => 'telefone', 'placeholder' => '(99) 99999-9999'])

    <div class="form-group" id="categoria-field" style="display:none;">
        <label for="categoria">Categoria</label>
        <div class="input-with-icon">
            <i class="ph ph-tag"></i>
            <select id="categoria" name="categoria">
                <option value="">Selecione</option>
                <option value="eletricista">Eletricista</option>
                <option value="encanador">Encanador</option>
                <option value="pedreiro">Pedreiro</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="endereco">Endereço</label>
        <button type="button" class="input-like-button" id="open-address-dialog">
            <i class="ph ph-map-pin"></i>
            <span>Cidade, Estado</span>
        </button>
    </div>

    @include('components.input-field', ['label' => 'Senha', 'icon' => 'ph-lock', 'type' => 'password', 'id' => 'password', 'name' => 'password', 'placeholder' => 'Mínimo 8 caracteres', 'required' => true])
    @include('components.input-field', ['label' => 'Confirmar Senha', 'icon' => 'ph-lock', 'type' => 'password', 'id' => 'password_confirmation', 'name' => 'password_confirmation', 'placeholder' => 'Confirme sua senha', 'required' => true])

    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <button type="button" class="btn btn-secondary">
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" class="google-icon">
        Continuar com Google
    </button>
</form>
