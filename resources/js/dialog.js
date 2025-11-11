document.addEventListener('DOMContentLoaded', () => {
    const tabButtons = document.querySelectorAll('.tab-button');
    const categoriaField = document.getElementById('categoria-field');
    const roleInput = document.getElementById('role-input');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            tabButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');

            const role = button.dataset.tabButton;
            roleInput.value = role;
            categoriaField.style.display = (role === 'prestador') ? 'block' : 'none';
        });
    });

    const addressDialog = document.getElementById('address-dialog');
    document.getElementById('open-address-dialog').addEventListener('click', () => addressDialog.classList.add('show'));
    document.getElementById('close-address-dialog').addEventListener('click', () => addressDialog.classList.remove('show'));
    document.getElementById('confirm-address-button').addEventListener('click', () => {
        document.getElementById('endereco_logradouro').value = document.getElementById('rua').value;
        document.getElementById('endereco_numero').value = document.getElementById('numero').value;
        document.getElementById('endereco_complemento').value = document.getElementById('referencia').value;
        document.getElementById('endereco_bairro').value = document.getElementById('bairro').value;
        document.getElementById('endereco_cidade').value = document.getElementById('cidade').value;
        document.getElementById('endereco_estado').value = 'MG';
        document.getElementById('endereco_cep').value = document.getElementById('cep').value;

        const cidade = document.getElementById('cidade').value;
        const estado = 'MG';
        document.getElementById('endereco-display').textContent = `${cidade}, ${estado}`;

        addressDialog.classList.remove('show');
    });
    addressDialog.querySelector('.dialog-overlay').addEventListener('click', () => addressDialog.classList.remove('show'));
});

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
document.getElementById('saveProfileBtn').addEventListener('click', function () {
    const form = document.getElementById('editProfileForm');
    if (form.checkValidity()) {
        document.getElementById('displayNome').value = document.getElementById('editNome').value;
        document.getElementById('displayEmail').value = document.getElementById('editEmail').value;
        document.getElementById('displayTelefone').value = document.getElementById('editTelefone').value;
        document.getElementById('displayLocalizacao').value = document.getElementById('editLocalizacao').value;

        const modal = bootstrap.Modal.getInstance(editProfileModal);
        modal.hide();
    } else {
        form.reportValidity();
    }
});
