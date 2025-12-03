<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepara os dados antes da validação (Limpa máscaras).
     */
    protected function prepareForValidation()
    {
        // Se vier campo documento, remove tudo que não for número
        if ($this->has('documento')) {
            $this->merge([
                'documento' => preg_replace('/\D/', '', $this->documento),
            ]);
        }
        
        // Se vier telefone, remove formatação visual
        if ($this->has('telefone')) {
            $this->merge([
                'telefone' => preg_replace('/\D/', '', $this->telefone),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Pega o ID do usuário logado
        $user = $this->user();
        // Pega o ID do prestador associado (se existir)
        $prestadorId = $user->prestador?->id;

        return [
            // --- Tabela USERS ---
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],

            // --- Tabela PRESTADORES (Nullable pois cliente comum não tem isso) ---
            'telefone' => ['nullable', 'string', 'max:20'],
            
            'documento' => [
                'nullable', 
                'string', 
                // Valida se é único na tabela prestadores, mas ignora o ID do prestador atual
                Rule::unique('prestadores', 'documento')->ignore($prestadorId)
            ],

            'categoria_id' => ['nullable', 'exists:categorias,id'],
            'descricao' => ['nullable', 'string', 'max:1000'], // Baseado no print

            // --- Endereço (Se estiver editando junto) ---
            'cep' => ['nullable', 'string'],
            'logradouro' => ['nullable', 'string'],
            'numero' => ['nullable', 'string'],
            'bairro' => ['nullable', 'string'],
            'cidade' => ['nullable', 'string'],
            'estado' => ['nullable', 'string', 'max:2'],
        ];
    }
}