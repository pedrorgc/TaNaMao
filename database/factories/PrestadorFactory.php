<?php

namespace Database\Factories;

use App\Models\Prestador;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Endereco;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrestadorFactory extends Factory
{
    protected $model = Prestador::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'documento' => $this->gerarDocumento(),
            'telefone' => $this->gerarTelefone(),
            'categoria_id' => function () {
                return Categoria::inRandomOrder()->first()->id;
            },
            'endereco_id' => function () {
                return Endereco::inRandomOrder()->first()->id;
            },
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Prestador $prestador) {
            $prestador->user()->update(['role_id' => 2]);
        });
    }

    public function comCnpj()
    {
        return $this->state(function (array $attributes) {
            return [
                'documento' => $this->gerarCnpj(),
            ];
        });
    }

    public function comCpf()
    {
        return $this->state(function (array $attributes) {
            return [
                'documento' => $this->gerarCpf(),
            ];
        });
    }

    private function gerarDocumento(): string
    {
        return rand(1, 10) <= 7 ? $this->gerarCpf() : $this->gerarCnpj();
    }

    private function gerarCpf(): string
    {
        $n1 = rand(0, 9);
        $n2 = rand(0, 9);
        $n3 = rand(0, 9);
        $n4 = rand(0, 9);
        $n5 = rand(0, 9);
        $n6 = rand(0, 9);
        $n7 = rand(0, 9);
        $n8 = rand(0, 9);
        $n9 = rand(0, 9);
        
        $d1 = $n9 * 2 + $n8 * 3 + $n7 * 4 + $n6 * 5 + $n5 * 6 + $n4 * 7 + $n3 * 8 + $n2 * 9 + $n1 * 10;
        $d1 = 11 - ($d1 % 11);
        if ($d1 >= 10) $d1 = 0;
        
        $d2 = $d1 * 2 + $n9 * 3 + $n8 * 4 + $n7 * 5 + $n6 * 6 + $n5 * 7 + $n4 * 8 + $n3 * 9 + $n2 * 10 + $n1 * 11;
        $d2 = 11 - ($d2 % 11);
        if ($d2 >= 10) $d2 = 0;
        
        return sprintf('%03d.%03d.%03d-%02d', $n1.$n2.$n3, $n4.$n5.$n6, $n7.$n8.$n9, $d1.$d2);
    }

    private function gerarCnpj(): string
    {
        $n1 = rand(0, 9);
        $n2 = rand(0, 9);
        $n3 = rand(0, 9);
        $n4 = rand(0, 9);
        $n5 = rand(0, 9);
        $n6 = rand(0, 9);
        $n7 = rand(0, 9);
        $n8 = rand(0, 9);
        $n9 = rand(0, 9);
        $n10 = rand(0, 9);
        $n11 = rand(0, 9);
        $n12 = rand(0, 9);
        
        $d1 = $n12 * 2 + $n11 * 3 + $n10 * 4 + $n9 * 5 + $n8 * 6 + $n7 * 7 + $n6 * 8 + $n5 * 9 + $n4 * 2 + $n3 * 3 + $n2 * 4 + $n1 * 5;
        $d1 = 11 - ($d1 % 11);
        if ($d1 >= 10) $d1 = 0;
        
        $d2 = $d1 * 2 + $n12 * 3 + $n11 * 4 + $n10 * 5 + $n9 * 6 + $n8 * 7 + $n7 * 8 + $n6 * 9 + $n5 * 2 + $n4 * 3 + $n3 * 4 + $n2 * 5 + $n1 * 6;
        $d2 = 11 - ($d2 % 11);
        if ($d2 >= 10) $d2 = 0;
        
        return sprintf('%02d.%03d.%03d/%04d-%02d', $n1.$n2, $n3.$n4.$n5, $n6.$n7.$n8, $n9.$n10.$n11.$n12, $d1.$d2);
    }

    private function gerarTelefone(): string
    {
        $ddds = ['11', '21', '31', '41', '51', '61', '71', '81', '91'];
        $ddd = $ddds[array_rand($ddds)];
        
        $prefixo = rand(8000, 9999);
        $sufixo = rand(1000, 9999);
        
        return "($ddd) 9$prefixo-$sufixo";
    }
}