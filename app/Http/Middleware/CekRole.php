<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            abort(403, 'Lu belum login.');
        }

        $userRole = auth()->user()->position;

        if ($userRole === 'owner') {
            return $next($request); // owner akses bebas
        }

        if (!in_array($userRole, $roles)) {
            abort(403, 'Lu gak punya akses.');
        }

        return $next($request);
    }
}
