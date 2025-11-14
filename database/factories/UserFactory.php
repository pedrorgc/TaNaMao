<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{


    protected static ?string $password;
    /**
     * @return array<string, mixed>
     **/
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => 3,
        ];
    }


    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }


    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => 1,
        ]);
    }

    public function prestador(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => 2,
        ]);
    }


    public function cliente(): static
    {
        return $this->state(fn(array $attributes) => [
            'role_id' => 3,
        ]);
    }
}
