<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class CheckIsPosMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->is_pos) {
            return $next($request);
        }
        abort(403);
    }
}
