<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckTallerRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->isTaller()) {
            abort(403, 'Acceso denegado. Solo los talleres pueden acceder a esta sección.');
        }

        return $next($request);
    }
}