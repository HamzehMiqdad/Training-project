<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActivated
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->activated) {
            Auth::logout();
            abort(403, 'Your account is disabled.');
        }

        return $next($request);
    }
}

