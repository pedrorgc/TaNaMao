<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|min:8|confirmed',

            'cpf'               => 'nullable|string|unique:clientes,cpf',
            'rg'                => 'nullable|string',
            'data_nascimento'   => 'nullable|date',
            'genero'            => 'nullable|string',
            'telefone'          => 'nullable|string',

            'cep'        => 'nullable|string',
            'logradouro' => 'nullable|string',
            'numero'     => 'nullable|string',
            'complemento'=> 'nullable|string',
            'bairro'     => 'nullable|string',
            'cidade'     => 'nullable|string',
            'estado'     => 'nullable|string|size:2',
        ];
    }

    public function prepareForValidation()
    {
        if ($this->has('cpf')) {
            $this->merge([
                'cpf' => preg_replace('/\D/', '', $this->cpf),
            ]);
        }
    }
}
