<div class="dialog" id="address-dialog">
    <div class="dialog-overlay"></div>
    <div class="dialog-content">
        <div class="dialog-header">
            <h2>Endereço</h2>
            <button class="close-button" id="close-address-dialog">&times;</button>
        </div>
        <div class="dialog-body">
            @include('components.input-field', ['label' => 'CEP', 'icon' => '', 'type' => 'text', 'id' => 'cep', 'placeholder' => '00000-000'])
            @include('components.input-field', ['label' => 'Rua / Logradouro', 'icon' => '', 'type' => 'text', 'id' => 'rua', 'placeholder' => 'Nome da sua rua'])

            <div class="form-group-row">
                @include('components.input-field', ['label' => 'Número', 'icon' => '', 'type' => 'text', 'id' => 'numero', 'placeholder' => '123'])
                @include('components.input-field', ['label' => 'Bairro', 'icon' => '', 'type' => 'text', 'id' => 'bairro', 'placeholder' => 'Seu bairro'])
            </div>

            @include('components.input-field', ['label' => 'Cidade', 'icon' => '', 'type' => 'text', 'id' => 'cidade', 'placeholder' => 'Sua cidade'])
            @include('components.input-field', ['label' => 'Referência', 'icon' => '', 'type' => 'text', 'id' => 'referencia', 'placeholder' => 'Ex: Próximo ao mercado'])
        </div>
        <div class="dialog-footer">
            <button type="button" class="btn btn-primary" id="confirm-address-button">Confirmar</button>
        </div>
    </div>
</div>
