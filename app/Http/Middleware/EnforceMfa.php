<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnforceMfa
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && !$request->user()->mfa_enabled) {
            abort(403, 'Enable MFA to access admin area.');
        }

        return $next($request);
    }
}
