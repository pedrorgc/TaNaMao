<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreServicoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->prestador !== null;
    }

    public function rules(): array
    {
        $rules = [
            'titulo' => 'required|string|max:200',
            'descricao' => 'required|string|min:50|max:2000',
            'categoria_id' => 'required|exists:categorias,id',
            'tipo_servico' => 'required|string|max:100',
            'tipo_valor' => ['required', Rule::in(['hora', 'fixo', 'orcamento'])],
            'cpf_cnpj_servico' => 'nullable|string|max:20',
            'telefone_servico' => 'nullable|string|max:20',
            'usar_endereco_cadastro' => 'nullable|boolean',
        ];

        if ($this->input('tipo_valor') === 'hora') {
            $rules['valor_hora'] = 'required|numeric|min:0.01|max:999999.99';
        } elseif ($this->input('tipo_valor') === 'fixo') {
            $rules['valor_fixo'] = 'required|numeric|min:0.01|max:999999.99';
        }

        if (!$this->input('usar_endereco_cadastro')) {
            $rules['cidade_servico'] = 'required|string|max:100';
            $rules['estado_servico'] = 'required|string|size:2';
            $rules['cep_servico'] = 'nullable|string|max:9';
        }

        if ($this->filled('cpf_cnpj_servico')) {
            $cpfCnpj = preg_replace('/[^0-9]/', '', $this->input('cpf_cnpj_servico'));
            
            if (strlen($cpfCnpj) === 11) {
                $rules['cpf_cnpj_servico'] = ['required', 'cpf'];
            } elseif (strlen($cpfCnpj) === 14) {
                $rules['cpf_cnpj_servico'] = ['required', 'cnpj'];
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'O título do serviço é obrigatório.',
            'titulo.max' => 'O título não pode ter mais que 200 caracteres.',
            'descricao.required' => 'A descrição do serviço é obrigatória.',
            'descricao.min' => 'A descrição deve ter pelo menos 50 caracteres.',
            'descricao.max' => 'A descrição não pode ter mais que 2000 caracteres.',
            'categoria_id.required' => 'Selecione uma categoria.',
            'categoria_id.exists' => 'A categoria selecionada é inválida.',
            'tipo_servico.required' => 'O tipo de serviço é obrigatório.',
            'tipo_valor.required' => 'Selecione o tipo de valor.',
            'tipo_valor.in' => 'Tipo de valor inválido.',
            'valor_hora.required' => 'Informe o valor por hora.',
            'valor_hora.numeric' => 'O valor por hora deve ser numérico.',
            'valor_hora.min' => 'O valor por hora deve ser maior que zero.',
            'valor_fixo.required' => 'Informe o valor fixo.',
            'valor_fixo.numeric' => 'O valor fixo deve ser numérico.',
            'valor_fixo.min' => 'O valor fixo deve ser maior que zero.',
            'cpf_cnpj_servico.cpf' => 'O CPF informado é inválido.',
            'cpf_cnpj_servico.cnpj' => 'O CNPJ informado é inválido.',
            'cidade_servico.required' => 'A cidade é obrigatória quando não usar o endereço do cadastro.',
            'estado_servico.required' => 'O estado é obrigatório quando não usar o endereço do cadastro.',
            'estado_servico.size' => 'O estado deve ter 2 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'titulo' => 'título',
            'descricao' => 'descrição',
            'categoria_id' => 'categoria',
            'tipo_servico' => 'tipo de serviço',
            'tipo_valor' => 'tipo de valor',
            'valor_hora' => 'valor por hora',
            'valor_fixo' => 'valor fixo',
            'cpf_cnpj_servico' => 'CPF/CNPJ do serviço',
            'telefone_servico' => 'telefone do serviço',
            'cidade_servico' => 'cidade',
            'estado_servico' => 'estado',
            'cep_servico' => 'CEP',
        ];
    }

    public function prepareForValidation()
    {
        if ($this->has('cpf_cnpj_servico')) {
            $this->merge([
                'cpf_cnpj_servico' => preg_replace('/[^0-9]/', '', $this->cpf_cnpj_servico)
            ]);
        }

        if ($this->has('cep_servico')) {
            $this->merge([
                'cep_servico' => preg_replace('/[^0-9]/', '', $this->cep_servico)
            ]);
        }

        foreach (['valor_hora', 'valor_fixo'] as $field) {
            if ($this->has($field)) {
                $value = str_replace(['.', ','], ['', '.'], $this->$field);
                $this->merge([$field => $value]);
            }
        }

        if ($this->has('usar_endereco_cadastro')) {
            $this->merge([
                'usar_endereco_cadastro' => $this->boolean('usar_endereco_cadastro')
            ]);
        }
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated();

        if (!isset($validated['cpf_cnpj_servico'])) {
            $prestador = Auth::user()->prestador;
            $validated['cpf_cnpj_servico'] = $prestador->documento ?? null;
        }

        if (!isset($validated['telefone_servico'])) {
            $prestador = Auth::user()->prestador;
            $validated['telefone_servico'] = $prestador->telefone ?? null;
        }

        return $validated;
    }
}