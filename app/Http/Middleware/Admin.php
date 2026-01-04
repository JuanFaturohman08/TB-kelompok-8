<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Hanya izinkan user yang sudah login dan berstatus admin
        abort_if(! auth()->check() || ! auth()->user()->is_admin, 403);

        return $next($request);
    }
}
