<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrestadorRequest extends FormRequest
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
            'documento'         => 'nullable|string|unique:prestadores,documento',
            'telefone'          => 'nullable|string',
            'categoria_id'      => 'nullable|exists:categorias,id',
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
        if ($this->has('documento')) {
            $this->merge([
                'documento' => preg_replace('/\D/', '', $this->documento),
            ]);
        }
    }
}
