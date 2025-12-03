<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Você precisa estar logado para acessar esta página.');
        }

        switch ($role) {
            case 'prestador':
                if (!$user->isPrestador()) {
                    return redirect()->route('home')
                        ->with('error', 'Acesso restrito para prestadores de serviço.');
                }
                
                if (!$user->prestador) {
                    if ($request->routeIs('servicos.create', 'servicos.store')) {
                        return redirect()->route('prestadores.create')
                            ->with('error', 'Complete seu cadastro como prestador antes de criar serviços.')
                            ->with('dados_usuario', [
                                'name' => $user->name,
                                'email' => $user->email,
                            ]);
                    }
                    
                    return redirect()->route('prestadores.create')
                        ->with('error', 'Complete seu cadastro como prestador para acessar esta área.');
                }
                
                if (isset($user->prestador->ativo) && !$user->prestador->ativo) {
                    Auth::logout();
                    return redirect()->route('login')
                        ->with('error', 'Sua conta de prestador está inativa. Entre em contato com o suporte.');
                }
                break;

            case 'cliente':
                if (!$user->isCliente()) {
                    abort(403, 'Acesso restrito para clientes.');
                }
                break;

            case 'admin':
                if (!$user->isAdmin()) {
                    abort(403, 'Acesso restrito para administradores.');
                }
                break;
        }

        return $next($request);
    }
}