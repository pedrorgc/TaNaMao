<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePrestadorRequest;
use App\Models\Categoria;
use App\Models\Prestador;
use App\Models\Role;
use App\Models\User;
use App\Services\EnderecoService;
use App\Services\PrestadorService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PrestadorController extends Controller
{
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();

            if ($user->isPrestador()) {
                if ($user->prestador()->exists()) {
                    return redirect()->route('servicos.create')
                        ->with('info', 'Você já possui cadastro de prestador.');
                }

                $dadosPreenchidos = [
                    'name' => $user->name,
                    'email' => $user->email,
                ];
            } else {
                $dadosPreenchidos = [
                    'name' => $user->name,
                    'email' => $user->email,
                ];
            }
        } else {
            $dadosPreenchidos = [];
        }

        if (session('dados_usuario')) {
            $dadosPreenchidos = array_merge($dadosPreenchidos, session('dados_usuario'));
        }

        $categorias = Categoria::where('ativo', true)->get();

        return view('pages.public.cadastro-prestador', compact('categorias', 'dadosPreenchidos'));
    }

    public function storePrestador(StorePrestadorRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            app(UserService::class)->updateUser($user, $data);

            if (!$user->isPrestador()) {
                /** @var Role|null  */
                $rolePrestador = Role::where('name', 'prestador')->first();
                if ($rolePrestador) {
                    $user->role_id = $rolePrestador->id;
                    $user->save();
                }
            }
        } else {
            /** @var User $user */
            $user = app(UserService::class)->createUser($data, User::ROLE_PRESTADOR);
            Auth::login($user);
            $request->session()->regenerate();
        }

        $endereco = app(EnderecoService::class)->createEndereco($data);

        app(PrestadorService::class)->createPrestador($user, $endereco, $data);

        $redirectTo = $request->has('redirect_to')
            ? $request->input('redirect_to')
            : 'home';

        if ($redirectTo === 'servicos.create') {
            return redirect()->route('servicos.create')
                ->with('success', 'Cadastro realizado! Agora você pode cadastrar seu primeiro serviço.');
        }

        return redirect()->route('home')
            ->with('success', 'Cadastro de prestador realizado com sucesso!');
    }

    public function edit(int $id): View
    {
        /** @var Prestador|null */
        $prestador = Prestador::with(['user', 'endereco'])->where('user_id', $id)->firstOrFail();

        /** @var User $authUser */
        $authUser = Auth::user();

        if ($authUser->id !== $prestador->user_id && !$authUser->isAdmin()) {
            abort(403, 'Você não tem permissão para editar este prestador.');
        }

        $categorias = Categoria::where('ativo', true)->get();

        return view('prestadores.edit', [
            'categorias' => $categorias,
            'prestador' => $prestador,
            'user' => $prestador->user,
            'endereco' => $prestador->endereco
        ]);
    }

    public function update(StorePrestadorRequest $request, int $id, Prestador $prestador): RedirectResponse
    {
        $data = $request->validated();

        /** @var User  */
        $authUser = Auth::user();


        if ($authUser->id !== $prestador->user_id && !$authUser->isAdmin()) {


            abort(403, 'Você não tem permissão para editar este prestador.');
        }

        /** @var User */
        $user = $prestador->user;

        app(UserService::class)->updateUser($user, $data);
        $endereco = app(EnderecoService::class)->updateEndereco($prestador->endereco, $data);
        app(PrestadorService::class)->updatePrestador($prestador, $endereco, $data);

        return back()->with('success', 'Dados atualizados com sucesso!');
    }
}
