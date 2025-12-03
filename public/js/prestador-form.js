class PrestadorForm {
    constructor() {
        this.init();
    }

    init() {
        document.addEventListener('DOMContentLoaded', () => {
            this.setupPasswordToggle();
            this.setupCepSearch();
            this.setupFormValidation();
            this.setupAutoFieldTooltips();
            this.setupFormatting();
        });
    }

    togglePassword(inputId, iconElement) {
        const input = document.getElementById(inputId);
        const icon = iconElement.querySelector('i');

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("ph-eye");
            icon.classList.add("ph-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("ph-eye-slash");
            icon.classList.add("ph-eye");
        }
    }

    setupPasswordToggle() {
        document.querySelectorAll('.input-group-text[onclick*="togglePassword"]').forEach(button => {
            const onclick = button.getAttribute('onclick');
            if (onclick) {
                button.removeAttribute('onclick');
                const match = onclick.match(/togglePassword\('([^']+)', this\)/);
                if (match) {
                    button.addEventListener('click', () => {
                        this.togglePassword(match[1], button);
                    });
                }
            }
        });
    }

    setupCepSearch() {
        const cepInput = document.getElementById('cep');
        const buscarCepBtn = document.getElementById('buscar-cep-btn');
        const estadoInput = document.getElementById('estado');
        const cidadeInput = document.getElementById('cidade');
        const ruaInput = document.getElementById('rua');
        const bairroInput = document.getElementById('bairro');

        if (!cepInput) return;

        const buscarCep = async () => {
            const cep = cepInput.value.replace(/\D/g, '');

            if (cep.length !== 8) {
                this.showAlert('CEP inválido. Digite um CEP com 8 dígitos.', 'warning');
                return;
            }

            try {
                if (buscarCepBtn) {
                    buscarCepBtn.innerHTML = '<i class="ph ph-circle-notch ph-spin"></i>';
                    buscarCepBtn.disabled = true;
                }

                const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                const data = await response.json();

                if (data.erro) {
                    this.showAlert('CEP não encontrado. Verifique o número digitado.', 'danger');
                    return;
                }

                if (estadoInput) estadoInput.value = data.uf || '';
                if (cidadeInput) cidadeInput.value = data.localidade || '';
                if (ruaInput) ruaInput.value = data.logradouro || '';
                if (bairroInput) bairroInput.value = data.bairro || '';

                if (data.logradouro && ruaInput) {
                    ruaInput.focus();
                } else if (bairroInput) {
                    bairroInput.focus();
                }

                this.showAlert('Endereço encontrado com sucesso!', 'success');

            } catch (error) {
                console.error('Erro ao buscar CEP:', error);
                this.showAlert('Erro ao buscar CEP. Tente novamente.', 'danger');
            } finally {
                if (buscarCepBtn) {
                    buscarCepBtn.innerHTML = '<i class="ph ph-magnifying-glass"></i>';
                    buscarCepBtn.disabled = false;
                }
            }
        };
        if (buscarCepBtn) {
            buscarCepBtn.addEventListener('click', buscarCep);
        }

        cepInput.addEventListener('blur', buscarCep);

        cepInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                buscarCep();
            }
        });

        cepInput.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 5) {
                value = value.replace(/^(\d{5})(\d)/, '$1-$2');
            }
            e.target.value = value.substring(0, 9);
        });
    }

    setupFormatting() {
        const telefoneInput = document.getElementById('telefone');
        if (telefoneInput) {
            telefoneInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length <= 11) {
                    if (value.length <= 2) {
                        value = value.replace(/^(\d{0,2})/, '($1');
                    } else if (value.length <= 7) {
                        value = value.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
                    } else {
                        value = value.replace(/^(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
                    }
                }
                e.target.value = value.substring(0, 15);
            });
        }

        const documentoInput = document.getElementById('documento');
        if (documentoInput) {
            documentoInput.addEventListener('input', (e) => {
                let value = e.target.value.replace(/\D/g, '');

                if (value.length <= 11) { 
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                } else { 
                    value = value.replace(/(\d{2})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d)/, '$1.$2');
                    value = value.replace(/(\d{3})(\d)/, '$1/$2');
                    value = value.replace(/(\d{4})(\d{1,2})$/, '$1-$2');
                }

                e.target.value = value.substring(0, 18);
            });
        }
    }

    setupFormValidation() {
        const form = document.getElementById('prestadorForm');
        if (!form) return;

        form.addEventListener('submit', (e) => {
            if (!this.validateForm(form)) {
                e.preventDefault();
                this.showFirstError(form);
            }
        });

        const inputs = form.querySelectorAll('input[required], select[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                this.validateField(input);
            });
        });
    }

    validateForm(form) {
        let isValid = true;
        const inputs = form.querySelectorAll('input[required], select[required]');

        inputs.forEach(input => {
            if (!this.validateField(input)) {
                isValid = false;
            }
        });

        const senha = document.getElementById('senha');
        const confirmarSenha = document.getElementById('confirmar-senha');

        if (senha && confirmarSenha) {
            if (senha.value !== confirmarSenha.value) {
                this.markInvalid(confirmarSenha, 'As senhas não coincidem');
                isValid = false;
            } else if (senha.value.length < 8) {
                this.markInvalid(senha, 'A senha deve ter pelo menos 8 caracteres');
                isValid = false;
            }
        }

        return isValid;
    }

    validateField(field) {
        let isValid = true;
        let message = '';

        this.clearValidation(field);

        if (!field.value.trim()) {
            message = 'Este campo é obrigatório';
            isValid = false;
        }

        if (field.id === 'email' && field.value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(field.value)) {
                message = 'E-mail inválido';
                isValid = false;
            }
        }

        if (field.id === 'cep' && field.value) {
            const cep = field.value.replace(/\D/g, '');
            if (cep.length !== 8) {
                message = 'CEP inválido';
                isValid = false;
            }
        }

        if (field.id === 'documento' && field.value) {
            const doc = field.value.replace(/\D/g, '');
            if (![11, 14].includes(doc.length)) {
                message = 'CPF/CNPJ inválido';
                isValid = false;
            }
        }

        if (field.id === 'telefone' && field.value) {
            const tel = field.value.replace(/\D/g, '');
            if (tel.length < 10) {
                message = 'Telefone inválido';
                isValid = false;
            }
        }

        if (!isValid) {
            this.markInvalid(field, message);
        } else {
            this.markValid(field);
        }

        return isValid;
    }

    markInvalid(field, message) {
        field.classList.add('is-invalid');
        field.classList.remove('is-valid');

        const existingFeedback = field.parentNode.querySelector('.invalid-feedback');
        if (existingFeedback) {
            existingFeedback.remove();
        }

        const feedback = document.createElement('div');
        feedback.className = 'invalid-feedback';
        feedback.textContent = message;
        field.parentNode.appendChild(feedback);
    }

    markValid(field) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');

        const invalidFeedback = field.parentNode.querySelector('.invalid-feedback');
        if (invalidFeedback) {
            invalidFeedback.remove();
        }
    }

    clearValidation(field) {
        field.classList.remove('is-invalid', 'is-valid');
        const feedback = field.parentNode.querySelector('.invalid-feedback');
        if (feedback) {
            feedback.remove();
        }
    }

    showFirstError(form) {
        const firstInvalid = form.querySelector('.is-invalid');
        if (firstInvalid) {
            firstInvalid.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
            firstInvalid.focus();
        }
    }

    setupAutoFieldTooltips() {
        const autoFields = document.querySelectorAll('.campo-auto-preenchido');

        autoFields.forEach(field => {
            field.addEventListener('focus', () => {
                this.showTooltip(field, 'Este campo foi preenchido automaticamente com os dados da sua conta. Você pode alterá-lo se necessário.');
            });

            field.addEventListener('blur', () => {
                this.removeTooltip(field);
            });
        });
    }

    showTooltip(element, message) {
        this.removeTooltip(element);

        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip-auto';
        tooltip.innerHTML = message;
        tooltip.style.cssText = `
            position: absolute;
            background-color: #6c63ff;
            color: white;
            padding: 0.5rem;
            border-radius: 0.25rem;
            z-index: 1000;
            top: 100%;
            left: 0;
            max-width: 300px;
            font-size: 0.85rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        `;

        element.parentNode.style.position = 'relative';
        element.parentNode.appendChild(tooltip);

        setTimeout(() => {
            this.removeTooltip(element);
        }, 3000);
    }

    removeTooltip(element) {
        const tooltip = element.parentNode.querySelector('.tooltip-auto');
        if (tooltip) {
            tooltip.parentNode.removeChild(tooltip);
        }
    }

    showAlert(message, type = 'info') {
        const oldAlerts = document.querySelectorAll('.form-alert');
        oldAlerts.forEach(alert => alert.remove());

        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show form-alert mt-2`;
        alertDiv.innerHTML = `
            <i class="ph ph-${type === 'success' ? 'check-circle' : type === 'warning' ? 'warning-circle' : 'info'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        const form = document.getElementById('prestadorForm');
        if (form) {
            form.prepend(alertDiv);
        }

        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
}

if (typeof window.prestadorForm === 'undefined') {
    window.prestadorForm = new PrestadorForm();
}