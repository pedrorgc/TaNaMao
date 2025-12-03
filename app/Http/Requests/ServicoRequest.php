<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ServicoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->prestador !== null;
    }

    public function rules(): array
    {
        $rules = [
            'tipo_servico' => 'required|string|max:100',
            'titulo' => 'required|string|max:200|unique:servicos,titulo',
            'descricao' => 'required|string|min:50|max:2000',
            'categoria_id' => 'nullable|exists:categorias,id',
            'tipo_valor' => ['required', Rule::in(['hora', 'fixo', 'orcamento'])],
            'endereco' => 'required|string|max:255',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|size:2',
            'cep' => 'required|string|max:10',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ];

        if ($this->filled('cpf_cnpj')) {
            $cpfCnpj = preg_replace('/[^0-9]/', '', $this->input('cpf_cnpj'));

            if (strlen($cpfCnpj) === 11) {
                $rules['cpf_cnpj'] = ['required', 'cpf'];
            } elseif (strlen($cpfCnpj) === 14) {
                $rules['cpf_cnpj'] = ['required', 'cnpj'];
            } else {
                $rules['cpf_cnpj'] = ['required', 'string', 'max:20'];
            }
        }

        if ($this->input('tipo_valor') === 'hora') {
            $rules['valor_hora'] = 'required|numeric|min:0.01|max:999999.99';
            $rules['valor_fixo'] = 'nullable|numeric|min:0';
        } elseif ($this->input('tipo_valor') === 'fixo') {
            $rules['valor_fixo'] = 'required|numeric|min:0.01|max:999999.99';
            $rules['valor_hora'] = 'nullable|numeric|min:0';
        } else {
            $rules['valor_hora'] = 'nullable|numeric|min:0';
            $rules['valor_fixo'] = 'nullable|numeric|min:0';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'tipo_servico.required' => 'O tipo de serviço é obrigatório.',
            'titulo.required' => 'O título do serviço é obrigatório.',
            'titulo.unique' => 'Já existe um serviço com este título.',
            'cpf_cnpj.required' => 'O CPF ou CNPJ é obrigatório.',
            'cpf_cnpj.cpf' => 'O CPF informado é inválido.',
            'cpf_cnpj.cnpj' => 'O CNPJ informado é inválido.',
            'descricao.required' => 'A descrição do serviço é obrigatória.',
            'descricao.min' => 'A descrição deve ter pelo menos 50 caracteres.',
            'endereco.required' => 'O endereço é obrigatório.',
            'cidade.required' => 'A cidade é obrigatória.',
            'estado.required' => 'O estado é obrigatório.',
            'estado.size' => 'O estado deve ter 2 caracteres (ex: MG, SP).',
            'cep.required' => 'O CEP é obrigatório.',
            'tipo_valor.required' => 'O tipo de valor é obrigatório.',
            'valor_hora.required' => 'O valor por hora é obrigatório quando o tipo é "Por Hora".',
            'valor_fixo.required' => 'O valor fixo é obrigatório quando o tipo é "Valor Fixo".',
            'valor_hora.min' => 'O valor por hora deve ser maior que zero.',
            'valor_fixo.min' => 'O valor fixo deve ser maior que zero.',
        ];
    }

    public function attributes(): array
    {
        return [
            'tipo_servico' => 'tipo de serviço',
            'cpf_cnpj' => 'CPF/CNPJ',
            'titulo' => 'título',
            'descricao' => 'descrição',
            'categoria_id' => 'categoria',
            'tipo_valor' => 'tipo de valor',
            'valor_hora' => 'valor por hora',
            'valor_fixo' => 'valor fixo',
            'endereco' => 'endereço',
            'cidade' => 'cidade',
            'estado' => 'estado',
            'cep' => 'CEP',
        ];
    }

    public function prepareForValidation()
    {
        if (!$this->has('cpf_cnpj') || empty($this->cpf_cnpj)) {
            $prestador = Auth::user()->prestador;
            if ($prestador && $prestador->documento) {
                $this->merge([
                    'cpf_cnpj' => preg_replace('/[^0-9]/', '', $prestador->documento)
                ]);
            }
        } else {
            $this->merge([
                'cpf_cnpj' => preg_replace('/[^0-9]/', '', $this->cpf_cnpj)
            ]);
        }

        if ($this->has('cep')) {
            $this->merge([
                'cep' => preg_replace('/[^0-9]/', '', $this->cep)
            ]);
        }

        if ($this->has('valor_hora')) {
            $this->merge([
                'valor_hora' => str_replace(',', '.', $this->valor_hora)
            ]);
        }

        if ($this->has('valor_fixo')) {
            $this->merge([
                'valor_fixo' => str_replace(',', '.', $this->valor_fixo)
            ]);
        }
    }
}
