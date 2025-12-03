<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'remember_token' => Str::random(10),
            'role_id' => $this->faker->randomElement([1, 2, 3]), 
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => 1,
                'email' => 'admin@example.com',
                'name' => 'Administrador',
            ];
        });
    }

    public function prestador()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => 2,
            ];
        });
    }

    public function cliente()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => 3,
            ];
        });
    }
}