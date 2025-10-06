<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - TaNaMao</title>
    {{-- A diretiva @vite irá carregar seu app.scss compilado --}}
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    {{-- Importando ícones do Phosphor Icons para usar nos inputs --}}
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body>

    <div class="auth-container">
        <div class="auth-card">
        <div class="auth-header">
            {{-- A função asset() cria o link correto para a pasta public --}}
            <img src="{{ asset('Imagem/logo.png') }}" alt="Logo TaNaMao" class="logo">
            <h1>Criar Conta</h1>
            <p>Escolha o tipo de conta</p>
        </div>

            <div class="tab-switcher">
                <button class="tab-button active" data-tab-button="cliente">Cliente</button>
                <button class="tab-button" data-tab-button="prestador">Prestador</button>
            </div>

            <form class="auth-form">
                <div class="form-group">
                    <label for="nome">Nome Completo</label>
                    <div class="input-with-icon">
                        <i class="ph ph-user"></i>
                        <input type="text" id="nome" placeholder="Seu nome completo">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <div class="input-with-icon">
                        <i class="ph ph-envelope-simple"></i>
                        <input type="email" id="email" placeholder="seu@email.com">
                    </div>
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <div class="input-with-icon">
                        <i class="ph ph-phone"></i>
                        <input type="tel" id="telefone" placeholder="(99) 99999-9999">
                    </div>
                </div>
                
                {{-- CAMPO QUE SÓ APARECE PARA PRESTADOR --}}
                <div class="form-group" id="categoria-field" style="display: none;">
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
                    {{-- Este é o gatilho para abrir o Dialog --}}
                    <button type="button" class="input-like-button" id="open-address-dialog">
                        <i class="ph ph-map-pin"></i>
                        <span>Cidade, Estado</span>
                    </button>
                </div>

                <div class="form-group">
                    <label for="senha">Senha</label>
                    <div class="input-with-icon">
                        <i class="ph ph-lock"></i>
                        <input type="password" id="senha" placeholder="Mínimo 8 caracteres">
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirmar-senha">Confirmar Senha</label>
                    <div class="input-with-icon">
                        <i class="ph ph-lock"></i>
                        <input type="password" id="confirmar-senha" placeholder="Confirme sua senha">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>
                <button type="button" class="btn btn-secondary">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" alt="Google" class="google-icon">
                    Continuar com Google
                </button>
            </form>

            <div class="auth-footer">
                <p>Já tem uma conta? <a href="#">Entrar</a></p>
            </div>
        </div>
    </div>

    <div class="dialog" id="address-dialog">
        <div class="dialog-overlay"></div>
        <div class="dialog-content">
            <div class="dialog-header">
                <h2>Endereço</h2>
                <button class="close-button" id="close-address-dialog">&times;</button>
            </div>
            <div class="dialog-body">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" id="cep" placeholder="00000-000">
                </div>
                <div class="form-group">
                    <label for="rua">Rua / Logradouro</label>
                    <input type="text" id="rua" placeholder="Nome da sua rua">
                </div>
                <div class="form-group-row">
                    <div class="form-group">
                        <label for="numero">Número</label>
                        <input type="text" id="numero" placeholder="123">
                    </div>
                    <div class="form-group">
                        <label for="bairro">Bairro</label>
                        <input type="text" id="bairro" placeholder="Seu bairro">
                    </div>
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" placeholder="Sua cidade">
                </div>
                 <div class="form-group">
                    <label for="referencia">Referência</label>
                    <input type="text" id="referencia" placeholder="Ex: Próximo ao mercado">
                </div>
            </div>
             <div class="dialog-footer">
                <button type="button" class="btn btn-primary" id="confirm-address-button">Confirmar</button>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Lógica para alternar entre Cliente e Prestador
            const tabButtons = document.querySelectorAll('.tab-button');
            const categoriaField = document.getElementById('categoria-field');

            tabButtons.forEach(button => {
                button.addEventListener('click', () => {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    if (button.dataset.tabButton === 'prestador') {
                        categoriaField.style.display = 'block';
                    } else {
                        categoriaField.style.display = 'none';
                    }
                });
            });

            // Lógica para abrir e fechar o Dialog de Endereço
            const openDialogBtn = document.getElementById('open-address-dialog');
            const closeDialogBtn = document.getElementById('close-address-dialog');
            const confirmAddressBtn = document.getElementById('confirm-address-button');
            const addressDialog = document.getElementById('address-dialog');
            const dialogOverlay = addressDialog.querySelector('.dialog-overlay');

            function openDialog() {
                addressDialog.classList.add('show');
            }

            function closeDialog() {
                addressDialog.classList.remove('show');
            }

            openDialogBtn.addEventListener('click', openDialog);
            closeDialogBtn.addEventListener('click', closeDialog);
            confirmAddressBtn.addEventListener('click', closeDialog);
            dialogOverlay.addEventListener('click', closeDialog);
        });
    </script>
</body>
</html>