<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'telefone' => 'nullable|string|max:20',
            'role' => 'required|string|in:cliente,prestador',
            'categoria' => 'nullable|string|required_if:role,prestador',
            'endereco' => 'required|array',
            'endereco.logradouro' => 'required|string|max:255',
            'endereco.numero' => 'required|string|max:10',
            'endereco.complemento' => 'nullable|string|max:255',
            'endereco.bairro' => 'required|string|max:255',
            'endereco.cidade' => 'required|string|max:255',
            'endereco.estado' => 'required|string|max:2',
            'endereco.cep' => 'required|string|max:10',
            'endereco.pais' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'A senha é obrigatória.',
            'password.min' => 'A senha deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'password_confirmation.required' => 'A confirmação da senha é obrigatória.',
            'role.required' => 'O tipo de conta é obrigatório.',
            'role.in' => 'O tipo de conta deve ser cliente ou prestador.',
            'categoria.required_if' => 'A categoria é obrigatória para prestadores.',
            'endereco.required' => 'O endereço é obrigatório.',
            'endereco.logradouro.required' => 'O logradouro é obrigatório.',
            'endereco.numero.required' => 'O número é obrigatório.',
            'endereco.bairro.required' => 'O bairro é obrigatório.',
            'endereco.cidade.required' => 'A cidade é obrigatória.',
            'endereco.estado.required' => 'O estado é obrigatório.',
            'endereco.cep.required' => 'O CEP é obrigatório.',
        ];
    }
}
