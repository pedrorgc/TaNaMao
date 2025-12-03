<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServicoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|min:20|max:2000',
            'categoria_id' => 'required|exists:categorias,id',
            'tipo_servico' => 'required|string|max:100',
            'cpf_cnpj_servico' => 'nullable|string|max:20',
            'telefone_servico' => 'nullable|string|max:20',
            'tipo_valor' => ['required', Rule::in(['hora', 'fixo', 'orcamento'])],
            'valor_hora' => 'required_if:tipo_valor,hora|numeric|min:0',
            'valor_fixo' => 'required_if:tipo_valor,fixo|numeric|min:0',
            'cep_servico' => 'nullable|string|max:10',
            'cidade_servico' => 'nullable|string|max:100',
            'estado_servico' => 'nullable|string|size:2',
            'usar_endereco_cadastro' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'O título do serviço é obrigatório.',
            'titulo.max' => 'O título não pode ter mais de 255 caracteres.',
            'descricao.required' => 'A descrição do serviço é obrigatória.',
            'descricao.min' => 'A descrição deve ter pelo menos 20 caracteres.',
            'descricao.max' => 'A descrição não pode ter mais de 2000 caracteres.',
            'categoria_id.required' => 'A categoria é obrigatória.',
            'categoria_id.exists' => 'A categoria selecionada é inválida.',
            'tipo_servico.required' => 'O tipo de serviço é obrigatório.',
            'tipo_valor.required' => 'O tipo de valor é obrigatório.',
            'tipo_valor.in' => 'O tipo de valor selecionado é inválido.',
            'valor_hora.required_if' => 'O valor por hora é obrigatório quando o tipo é por hora.',
            'valor_hora.numeric' => 'O valor por hora deve ser um número.',
            'valor_hora.min' => 'O valor por hora deve ser maior ou igual a zero.',
            'valor_fixo.required_if' => 'O valor fixo é obrigatório quando o tipo é fixo.',
            'valor_fixo.numeric' => 'O valor fixo deve ser um número.',
            'valor_fixo.min' => 'O valor fixo deve ser maior ou igual a zero.',
            'estado_servico.size' => 'O estado deve ter 2 caracteres.',
        ];
    }

    public function prepareForValidation()
    {
        if ($this->has('cpf_cnpj_servico')) {
            $this->merge([
                'cpf_cnpj_servico' => preg_replace('/[^0-9]/', '', $this->cpf_cnpj_servico)
            ]);
        }

        if ($this->has('telefone_servico')) {
            $this->merge([
                'telefone_servico' => preg_replace('/[^0-9]/', '', $this->telefone_servico)
            ]);
        }

        if ($this->has('cep_servico')) {
            $this->merge([
                'cep_servico' => preg_replace('/[^0-9]/', '', $this->cep_servico)
            ]);
        }
    }
}