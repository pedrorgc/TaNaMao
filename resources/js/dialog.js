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
