<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'password_confirmation' => ['required'],
            'role' => ['required', 'string', 'in:admin,user,moderator'],
            'telefone' => ['nullable', 'string', 'max:15'],
            'documento' => ['nullable', 'string', 'max:18'],
            'categoria' => ['nullable', 'string', 'max:255'],
            'cep' => ['nullable', 'string', 'max:9'],
            'rua' => ['nullable', 'string', 'max:255'],
            'numero' => ['nullable', 'string', 'max:10'],
            'bairro' => ['nullable', 'string', 'max:255'],
            'cidade' => ['nullable', 'string', 'max:255'],
            'estado' => ['nullable', 'string', 'max:2'],
        ];

        // CPF obrigatório apenas para clientes (role = user)
        if ($this->input('role') === 'user') {
            $rules['cpf'] = ['required', 'string', 'max:14'];
        } else {
            $rules['cpf'] = ['nullable', 'string', 'max:14'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser válido.',
            'email.unique' => 'Este e-mail já está cadastrado.',
            'password.required' => 'A senha é obrigatória.',
            'password.confirmed' => 'A confirmação de senha não corresponde.',
            'password_confirmation.required' => 'A confirmação de senha é obrigatória.',
            'role.required' => 'O papel do usuário é obrigatório.',
            'role.in' => 'O papel deve ser admin, user ou moderator.',
            'cpf.required' => 'O CPF é obrigatório.',
            'cpf.max' => 'O CPF deve ter no máximo 14 caracteres.',
            'telefone.max' => 'O telefone deve ter no máximo 15 caracteres.',
            'documento.max' => 'O documento deve ter no máximo 18 caracteres.',
            'categoria.max' => 'A categoria deve ter no máximo 255 caracteres.',
            'cep.max' => 'O CEP deve ter no máximo 9 caracteres.',
            'rua.max' => 'A rua deve ter no máximo 255 caracteres.',
            'numero.max' => 'O número deve ter no máximo 10 caracteres.',
            'bairro.max' => 'O bairro deve ter no máximo 255 caracteres.',
            'cidade.max' => 'A cidade deve ter no máximo 255 caracteres.',
            'estado.max' => 'O estado deve ter no máximo 2 caracteres.',
        ];
    }
}
