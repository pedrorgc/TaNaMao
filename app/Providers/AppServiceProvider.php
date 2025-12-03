<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(\App\Services\ServicoService::class, function ($app) {
            return new \App\Services\ServicoService();
        });

        $this->app->bind(\App\Services\CategoriaService::class, function ($app) {
            return new \App\Services\CategoriaService();
        });
    }

    public function boot()
    {
        Validator::extend('cpf_cnpj', function ($attribute, $value, $parameters, $validator) {
            $value = preg_replace('/[^0-9]/', '', $value);
            
            if (strlen($value) == 11) {
                return $this->validarCpf($value);
            } elseif (strlen($value) == 14) {
                return $this->validarCnpj($value);
            }
            
            return false;
        });

        Validator::replacer('cpf_cnpj', function ($message, $attribute, $rule, $parameters) {
            return 'O CPF ou CNPJ informado é inválido.';
        });
    }

    private function validarCpf($cpf)
    {
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
    }

    private function validarCnpj($cnpj)
    {
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
    }
}