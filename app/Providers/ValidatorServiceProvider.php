<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidatorServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Validator::extend('cpf', function ($attribute, $value, $parameters, $validator) {
            $cpf = preg_replace('/[^0-9]/', '', $value);
            
            if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
                return false;
            }

            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }
            return true;
        });

        Validator::extend('cnpj', function ($attribute, $value, $parameters, $validator) {
            $cnpj = preg_replace('/[^0-9]/', '', $value);
            
            if (strlen($cnpj) != 14) {
                return false;
            }

            for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
                $soma += $cnpj[$i] * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }
            $resto = $soma % 11;
            if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
                return false;
            }

            for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
                $soma += $cnpj[$i] * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }
            $resto = $soma % 11;
            return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
        });

        Validator::replacer('cpf', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'O :attribute informado é inválido.');
        });

        Validator::replacer('cnpj', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'O :attribute informado é inválido.');
        });
    }
}