<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->isUser()) {
            abort(403, 'Acceso denegado. Solo los usuarios pueden acceder a esta sección.');
        }

        return $next($request);
    }
}