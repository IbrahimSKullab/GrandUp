<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        /* if (! $request->expectsJson()) {
            if ($request->routeIs('admin.*')) {
                return route('admin.login');
            }
            if ($request->routeIs('seller.*')) {
                return route('seller.login');
            }

            return redirect('/');
        } */
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
