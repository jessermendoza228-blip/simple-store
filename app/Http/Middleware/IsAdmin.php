<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Access Denied');
        }

        if ($user->role !== 'admin') {
            abort(403, 'Access Denied');
        }

        return $next($request);
    }
}