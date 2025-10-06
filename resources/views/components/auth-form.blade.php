<form class="auth-form">
    @include('components.input-field', ['label' => 'Nome Completo', 'icon' => 'ph-user', 'type' => 'text', 'id' => 'nome', 'placeholder' => 'Seu nome completo'])

    @include('components.input-field', ['label' => 'E-mail', 'icon' => 'ph-envelope-simple', 'type' => 'email', 'id' => 'email', 'placeholder' => 'seu@email.com'])

    @include('components.input-field', ['label' => 'Telefone', 'icon' => 'ph-phone', 'type' => 'tel', 'id' => 'telefone', 'placeholder' => '(99) 99999-9999'])

    <div class="form-group" id="categoria-field" style="display:none;">
        <label for="categoria">Categoria</label>
        <div class="input-with-icon">
            <i class="ph ph-tag"></i>
            <select id="categoria">
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

    @include('components.input-field', ['label' => 'Senha', 'icon' => 'ph-lock', 'type' => 'password', 'id' => 'senha', 'placeholder' => 'Mínimo 8 caracteres'])
    @include('components.input-field', ['label' => 'Confirmar Senha', 'icon' => 'ph-lock', 'type' => 'password', 'id' => 'confirmar-senha', 'placeholder' => 'Confirme sua senha'])

    <button type="submit" class="btn btn-primary">Cadastrar</button>
    <button type="button" class="btn btn-secondary">
        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" class="google-icon">
        Continuar com Google
    </button>
</form>
