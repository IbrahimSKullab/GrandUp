<?php

namespace App\Http\Middleware;

use App\Enums\ShippingEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckShippingCompanyStatusMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->account_status == ShippingEnum::REQUIRE_APPROVAL->name) {
                Auth::logout();

                return redirect()->route('seller.login')->with('error', __('Your account is still in review process'));
            }
            if (Auth::user()->account_status == ShippingEnum::SUSPENDED->name) {
                Auth::logout();

                return redirect()->route('seller.login')->with('error', __('Your account is suspended please contact support'));
            }
        }

        return $next($request);
    }
}
