<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if ($role === 'prestador' && !auth()->user()->isPrestador()) {
            abort(403);
        }

        if ($role === 'cliente' && !auth()->user()->isCliente()) {
            abort(403);
        }

        if ($role === 'admin' && !auth()->user()->isAdmin()) {
            abort(403);
        }

        return $next($request);
    }
}
