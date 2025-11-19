document.addEventListener('DOMContentLoaded', () => {

    const campoCep = document.getElementById('cep');
    const campoEstado = document.getElementById('estado');
    const campoCidade = document.getElementById('cidade');

    campoEstado.setAttribute('readonly', true);
    campoCidade.setAttribute('readonly', true);

    campoCep.addEventListener('blur', () => {
        const cep = campoCep.value.replace(/\D/g, '');

        if (cep.length !== 8) return;

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(res => res.json())
            .then(data => {
                if (data.erro) {
                    console.error("CEP não encontrado.");
                    return;
                }

                // Preenche os inputs automaticamente
                campoEstado.value = data.uf;
                campoCidade.value = data.localidade;
            })
            .catch(err => console.error("Erro ao consultar ViaCEP:", err));
    });

});
