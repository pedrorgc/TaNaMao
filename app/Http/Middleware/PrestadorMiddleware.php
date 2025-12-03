<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PrestadorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!Auth::user()->prestador) {
            return redirect()->route('home')
                ->with('error', 'Você precisa ser um prestador de serviços para acessar esta área.');
        }

        if (!Auth::user()->prestador->ativo) {
            Auth::logout();
            return redirect()->route('login')
                ->with('error', 'Sua conta de prestador está inativa. Entre em contato com o suporte.');
        }

        return $next($request);
    }
}