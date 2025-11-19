<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403);
        }
        if ($role === 'prestador' && !$user->isPrestador()) {
            abort(403);
        }
        if ($role === 'cliente' && !$user->isCliente()) {
            abort(403);
        }
        if ($role === 'admin' && !$user->isAdmin()) {
            abort(403);
        }
        return $next($request);
    }
}
