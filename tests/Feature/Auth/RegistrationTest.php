<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'telefone' => '(11) 99999-9999',
            'role' => 'cliente',
            'endereco' => [
                'logradouro' => 'Rua Teste',
                'numero' => '123',
                'complemento' => 'Apto 1',
                'bairro' => 'Centro',
                'cidade' => 'Almenara',
                'estado' => 'MG',
                'cep' => '01000-000',
                'pais' => 'Brasil',
            ],
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/home');
    }
}
