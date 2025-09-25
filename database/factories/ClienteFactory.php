<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{

    protected $model = Cliente::class;



    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'cpf' => $this->faker->unique()->numerify('###########'),
            'rg' => $this->faker->numerify('#########'),
            'data_nascimento' => $this->faker->date(),
            'genero' => $this->faker->randomElement(['M', 'F']),
            'role_id'=>null,
            'telefone' => $this->faker->phoneNumber(),
            'endereco_id' => null,
        ];
    }
}
