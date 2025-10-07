document.addEventListener('DOMContentLoaded', () => {
    const tabButtons = document.querySelectorAll('.tab-button');
    const categoriaField = document.getElementById('categoria-field');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            tabButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            categoriaField.style.display = (button.dataset.tabButton === 'prestador') ? 'block' : 'none';
        });
    });

    const addressDialog = document.getElementById('address-dialog');
    document.getElementById('open-address-dialog').addEventListener('click', () => addressDialog.classList.add('show'));
    document.getElementById('close-address-dialog').addEventListener('click', () => addressDialog.classList.remove('show'));
    document.getElementById('confirm-address-button').addEventListener('click', () => addressDialog.classList.remove('show'));
    addressDialog.querySelector('.dialog-overlay').addEventListener('click', () => addressDialog.classList.remove('show'));
});

// Função para abrir o modal de edição de perfil

// Preencher modal com valores atuais ao abrir
const editProfileModal = document.getElementById('editProfileModal');
editProfileModal.addEventListener('show.bs.modal', function (event) {
    const nome = document.getElementById('displayNome').value;
    const email = document.getElementById('displayEmail').value;
    const telefone = document.getElementById('displayTelefone').value;
    const localizacao = document.getElementById('displayLocalizacao').value;
    document.getElementById('editNome').value = nome;
    document.getElementById('editEmail').value = email;
    document.getElementById('editTelefone').value = telefone;
    document.getElementById('editLocalizacao').value = localizacao;
});
// Salvar alterações ao clicar no botão
document.getElementById('saveProfileBtn').addEventListener('click', function () {
    const form = document.getElementById('editProfileForm');
    if (form.checkValidity()) { // Validação básica do formulário
        document.getElementById('displayNome').value = document.getElementById('editNome').value;
        document.getElementById('displayEmail').value = document.getElementById('editEmail').value;
        document.getElementById('displayTelefone').value = document.getElementById('editTelefone').value;
        document.getElementById('displayLocalizacao').value = document.getElementById('editLocalizacao').value;
        // Aqui você pode adicionar código para enviar ao servidor (ex.: fetch/AJAX no Laravel)
        // alert('Alterações salvas!'); // Feedback opcional
                        const modal = bootstrap.Modal.getInstance(editProfileModal);
        modal.hide();
    } else {
        form.reportValidity(); // Mostra erros de validação
    }
});