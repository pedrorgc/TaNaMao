<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class LocalidadesController extends Controller
{
    public function estados()
    {
        $response = Http::get('https://servicodados.ibge.gov.br/api/v1/localidades/estados');
        return $response->json();
    }

    public function cidades($uf)
    {
        $response = Http::get("https://servicodados.ibge.gov.br/api/v1/localidades/estados/{$uf}/municipios");
        return $response->json();
    }
}
