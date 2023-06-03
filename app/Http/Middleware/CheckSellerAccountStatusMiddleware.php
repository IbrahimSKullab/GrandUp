<?php

namespace App\Http\Middleware;

use Closure;
use App\Enums\SellerEnum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\HandleApiResponseTrait;

class CheckSellerAccountStatusMiddleware
{
    use HandleApiResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user() ?: $request->user();

//        if ($request->expectsJson()) {
//            return response()->json([
//                'success' => true,
//            ]);
//        } else {
//            return response()->json([
//                'success' => false,
//            ]);
//        }

        if (Auth::user()->account_status == SellerEnum::REQUIRE_APPROVAL->name) {
            Auth::user()->tokens()->delete();
            return $this::sendFailedResponse(__('Your Account is still in approval status'));
        }

        if (Auth::user()->account_status == SellerEnum::SUSPENDED->name) {
            Auth::user()->tokens()->delete();

            return $this::sendFailedResponse(__('Your Account is suspend, please contact support'));
        }

        return $next($request);
    }
}
