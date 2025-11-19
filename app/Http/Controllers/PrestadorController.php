<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrestadorRequest;
use App\Services\EnderecoService;
use App\Services\PrestadorService;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PrestadorController extends Controller
{
    public function storePrestador(StorePrestadorRequest$request): RedirectResponse
{
    $data = $request->validated();

    $user = app(UserService::class)->createUser($data, 2);
    $endereco = app(EnderecoService::class)->createEndereco($data);
    app(PrestadorService::class)->createPrestador($user, $endereco, $data);

    return redirect()->route('home')
        ->with('success', 'Prestador cadastrado com sucesso!');
}

}
