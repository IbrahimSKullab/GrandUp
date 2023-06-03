<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\SellerEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSellerStatusMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->account_status == SellerEnum::REQUIRE_APPROVAL->name) {
                Auth::logout();

                return redirect()->route('seller.login')->with('error', __('Your account is still in review process'));
            }
            if (Auth::user()->account_status == SellerEnum::SUSPENDED->name) {
                Auth::logout();

                return redirect()->route('seller.login')->with('error', __('Your account is suspended please contact support'));
            }
        }

        return $next($request);
    }
}
