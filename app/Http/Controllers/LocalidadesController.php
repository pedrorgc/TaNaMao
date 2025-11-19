<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class LocalidadesController extends Controller
{
    public function cep($cep)
    {
        $cep = preg_replace('/\D/', '', $cep);
        if (strlen($cep) !== 8) {
            return response()->json(['erro' => 'CEP inválido.'], 400);
        }

        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed() || isset($response->json()['erro'])) {
            return response()->json(['erro' => 'CEP não encontrado.'], 404);
        }

        return $response->json();
    }
}
