document.addEventListener('DOMContentLoaded', function() {
    const textareaDescricao = document.querySelector('textarea[name="descricao"]');
    const contadorCaracteres = document.getElementById('contador-caracteres');
    
    if (textareaDescricao && contadorCaracteres) {
        textareaDescricao.addEventListener('input', function() {
            const caracteres = this.value.length;
            contadorCaracteres.textContent = `${caracteres}/1000 caracteres`;
            
            if (caracteres > 1000) {
                contadorCaracteres.classList.remove('text-muted');
                contadorCaracteres.classList.add('text-danger');
            } else {
                contadorCaracteres.classList.remove('text-danger');
                contadorCaracteres.classList.add('text-muted');
            }
        });
        
        textareaDescricao.dispatchEvent(new Event('input'));
    }
    
    const tipoValorSelect = document.getElementById('tipo_valor');
    const campoValorHora = document.getElementById('campo_valor_hora');
    const campoValorFixo = document.getElementById('campo_valor_fixo');
    const orcamentoInfo = document.getElementById('orcamento_info');
    
    function atualizarCamposValor() {
        const valor = tipoValorSelect.value;
        
        if (campoValorHora.style.display === 'block') {
            campoValorHora.style.opacity = '0';
            setTimeout(() => {
                campoValorHora.style.display = 'none';
            }, 300);
        }
        
        if (campoValorFixo.style.display === 'block') {
            campoValorFixo.style.opacity = '0';
            setTimeout(() => {
                campoValorFixo.style.display = 'none';
            }, 300);
        }
        
        if (orcamentoInfo.style.display === 'block') {
            orcamentoInfo.style.opacity = '0';
            setTimeout(() => {
                orcamentoInfo.style.display = 'none';
            }, 300);
        }
        
        if (campoValorHora.querySelector('input')) {
            campoValorHora.querySelector('input').removeAttribute('required');
        }
        if (campoValorFixo.querySelector('input')) {
            campoValorFixo.querySelector('input').removeAttribute('required');
        }
        
        setTimeout(() => {
            if (valor === 'hora') {
                campoValorHora.style.display = 'block';
                setTimeout(() => {
                    campoValorHora.style.opacity = '1';
                    if (campoValorHora.querySelector('input')) {
                        campoValorHora.querySelector('input').setAttribute('required', 'required');
                    }
                }, 10);
            } else if (valor === 'fixo') {
                campoValorFixo.style.display = 'block';
                setTimeout(() => {
                    campoValorFixo.style.opacity = '1';
                    if (campoValorFixo.querySelector('input')) {
                        campoValorFixo.querySelector('input').setAttribute('required', 'required');
                    }
                }, 10);
            } else if (valor === 'orcamento') {
                orcamentoInfo.style.display = 'block';
                setTimeout(() => {
                    orcamentoInfo.style.opacity = '1';
                }, 10);
            }
        }, 300);
    }
    
    if (tipoValorSelect) {
        tipoValorSelect.addEventListener('change', atualizarCamposValor);
        atualizarCamposValor();
    }
    
    const campoCep = document.getElementById('cep');
    const campoEstado = document.getElementById('estado');
    const campoCidade = document.getElementById('cidade');
    const campoEndereco = document.querySelector('input[name="endereco"]');
    const botaoBuscarCep = document.getElementById('buscar-cep');
    const mapa = document.getElementById('mapa');
    
    const isCampoCepReadOnly = campoCep && campoCep.hasAttribute('readonly');
    
    if (!isCampoCepReadOnly && campoCep) {
        function buscarCEP() {
            const cep = campoCep.value.replace(/\D/g, '');
            
            if (cep.length !== 8) {
                mostrarAlerta('CEP inválido. Digite um CEP com 8 dígitos.', 'warning');
                return;
            }
            
            if (botaoBuscarCep) {
                botaoBuscarCep.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                botaoBuscarCep.disabled = true;
            }
            
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(res => res.json())
                .then(data => {
                    if (data.erro) {
                        mostrarAlerta('CEP não encontrado. Verifique o número digitado.', 'danger');
                        return;
                    }
                    
                    if (campoEstado) campoEstado.value = data.uf || '';
                    if (campoCidade) campoCidade.value = data.localidade || '';
                    if (campoEndereco) {
                        campoEndereco.value = `${data.logradouro || ''}${data.bairro ? ' - ' + data.bairro : ''}`;
                    }
                    
                    if (mapa) {
                        const enderecoMapa = `${data.logradouro || ''}, ${data.localidade || ''}, ${data.uf || ''}`.replace(/ /g, '+');
                        mapa.src = `https://www.google.com/maps?q=${enderecoMapa}&output=embed&z=15`;
                    }
                    
                    mostrarAlerta('Endereço encontrado com sucesso!', 'success');
                })
                .catch(err => {
                    console.error("Erro ao consultar ViaCEP:", err);
                    mostrarAlerta('Erro ao buscar CEP. Tente novamente.', 'danger');
                })
                .finally(() => {
                    if (botaoBuscarCep) {
                        botaoBuscarCep.innerHTML = '<i class="fas fa-search"></i>';
                        botaoBuscarCep.disabled = false;
                    }
                });
        }
        
        campoCep.addEventListener('blur', buscarCEP);
        if (botaoBuscarCep) {
            botaoBuscarCep.addEventListener('click', buscarCEP);
        }
        
        campoCep.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                buscarCEP();
            }
        });
    }
    
    function mostrarAlerta(mensagem, tipo) {
        const alertasAntigos = document.querySelectorAll('.cep-alerta');
        alertasAntigos.forEach(alerta => alerta.remove());
        
        const alerta = document.createElement('div');
        alerta.className = `alert alert-${tipo} alert-dismissible fade show mt-2 cep-alerta`;
        alerta.innerHTML = `
            <i class="fas fa-${tipo === 'success' ? 'check-circle' : tipo === 'warning' ? 'exclamation-triangle' : 'times-circle'} me-2"></i>
            ${mensagem}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        if (campoCep && campoCep.parentNode && campoCep.parentNode.parentNode) {
            campoCep.parentNode.parentNode.appendChild(alerta);
        }
        
        setTimeout(() => {
            if (alerta.parentNode) {
                alerta.remove();
            }
        }, 5000);
    }
    
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                
                const primeiroInvalido = form.querySelector(':invalid');
                if (primeiroInvalido) {
                    primeiroInvalido.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    primeiroInvalido.focus();
                }
            }
            
            form.classList.add('was-validated');
        }, false);
    });
    
    if (campoValorHora) campoValorHora.style.opacity = '0';
    if (campoValorFixo) campoValorFixo.style.opacity = '0';
    if (orcamentoInfo) orcamentoInfo.style.opacity = '0';
});