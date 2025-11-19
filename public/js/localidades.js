document.addEventListener('DOMContentLoaded', async () => {
    const estadoSelect = document.getElementById('estado');
    const cidadeSelect = document.getElementById('cidade');

    async function carregarEstados() {
        const response = await fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
        const estados = await response.json();

        estados.sort((a, b) => a.sigla.localeCompare(b.sigla));

        estados.forEach(estado => {
            const option = document.createElement('option');
            option.value = estado.sigla;
            option.textContent = estado.sigla;
            estadoSelect.appendChild(option);
        });
    }

    async function carregarCidades(uf) {
        cidadeSelect.innerHTML = '<option value="">Carregando...</option>';

        const response = await fetch(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${uf}/municipios`);
        const cidades = await response.json();

        cidadeSelect.innerHTML = '<option value="">Selecione a cidade</option>';

        cidades.forEach(cidade => {
            const option = document.createElement('option');
            option.value = cidade.nome;
            option.textContent = cidade.nome;
            cidadeSelect.appendChild(option);
        });
    }

    estadoSelect.addEventListener('change', () => {
        const uf = estadoSelect.value;
        if (uf) {
            carregarCidades(uf);
        }
    });

    carregarEstados();
});
