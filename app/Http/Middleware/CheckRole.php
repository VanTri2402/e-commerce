<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (Auth::check() && in_array(Auth::user()->role, $roles, true)) {
            return $next($request);
        }

        abort(403, 'Bạn không có quyền truy cập trang này.');
    }
}