document.addEventListener('DOMContentLoaded', function () {
  const cpf = document.getElementById('cpf');
  const cep = document.getElementById('cep');
  const telefone = document.getElementById('telefone');
  const rua = document.getElementById('rua');
  const bairro = document.getElementById('bairro');
  const cidade = document.getElementById('cidade');
  const estado = document.getElementById('estado');
  const numero = document.getElementById('numero');

  if (cpf) {
    cpf.addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length <= 11) {
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
      }
      e.target.value = value;
    });
  }

  if (cep) {
    cep.addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length <= 8) {
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
      }
      e.target.value = value;
    });

    cep.addEventListener('blur', function (e) {
      const c = e.target.value.replace(/\D/g, '');
      if (c.length === 8) {
        fetch(`https://viacep.com.br/ws/${c}/json/`)
          .then(r => r.json())
          .then(data => {
            if (!data.erro) {
              if (rua) rua.value = data.logradouro || '';
              if (bairro) bairro.value = data.bairro || '';
              if (cidade) {
                if (cidade.tagName.toLowerCase() === 'select') {
                  let opt = Array.from(cidade.options).find(o => o.value === data.localidade);
                  if (!opt) {
                    opt = document.createElement('option');
                    opt.value = data.localidade;
                    opt.textContent = data.localidade;
                    cidade.appendChild(opt);
                  }
                  cidade.value = data.localidade;
                } else {
                  cidade.value = data.localidade || '';
                }
              }
              if (estado && data.uf) estado.value = data.uf;
              if (numero) numero.focus();
            }
          })
          .catch(err => console.error('Erro ao buscar CEP:', err));
      }
    });
  }

  if (telefone) {
    telefone.addEventListener('input', function (e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length <= 11) {
        value = value.replace(/(\d{2})(\d)/, '($1) $2');
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
      }
      e.target.value = value;
    });
  }
});
