<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
// ⬇️ --- ADICIONE ESTAS DUAS LINHAS [T-04] --- ⬇️
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    // ⬇️ --- ESTE É O MÉTODO 'HANDLE' SUBSTITUÍDO [T-04] --- ⬇️
    // Note o "...$roles" que foi adicionado
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // [T-04] O "Norte" pede para verificar o 'role'.

        // 1. Verificamos se o utilizador está logado (Auth::check()).
        // 2. Verificamos se a 'role' do utilizador logado (Auth::user()->role)
        //    está na lista de $roles permitidas (que vêm da rota).
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            
            // Se não estiver logado ou não tiver a 'role' certa,
            // negamos o acesso. 403 significa "Proibido".
            abort(403, 'ACESSO NÃO AUTORIZADO.');
        }

        // Se ele tiver a 'role' certa, o "porteiro" deixa ele passar.
        return $next($request);
    }
}