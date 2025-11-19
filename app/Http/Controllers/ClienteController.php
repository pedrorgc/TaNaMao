<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use App\Services\ClienteService;
use App\Services\EnderecoService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ClienteController extends Controller
{

    public function storeCliente(StoreClienteRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = app(UserService::class)->createUser($data, 3);
        $endereco = app(EnderecoService::class)->createEndereco($data);
        app(ClienteService::class)->createCliente($user, $endereco, $data);

        return redirect()->route('home')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }
}
