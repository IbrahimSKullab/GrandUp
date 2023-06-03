<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class CheckIsStaffMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->is_staff) {
            return $next($request);
        }

        abort(403);
    }
}
