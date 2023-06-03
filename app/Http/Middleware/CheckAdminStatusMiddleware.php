<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class CheckAdminStatusMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->status == 0) {
                Auth::logout();

                return redirect()->route('admin.login')->with('error', __('Your account has been suspended please contact support'));
            }
        }

        return $next($request);
    }
}
