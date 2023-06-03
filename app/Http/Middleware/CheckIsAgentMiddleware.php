<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class CheckIsAgentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->is_agent) {
            return $next($request);
        }
        abort(403);
    }
}
