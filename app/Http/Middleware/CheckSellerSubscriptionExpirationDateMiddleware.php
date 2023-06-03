<?php

namespace App\Http\Middleware;

use App\Models\Seller;
use Auth;
use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Traits\HandleApiResponseTrait;

class CheckSellerSubscriptionExpirationDateMiddleware
{
    use HandleApiResponseTrait;

    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        if (! is_null($seller->plan_expired_at)) {
            $plan_expired_at = Carbon::parse($seller->plan_expired_at);
            if (now()->gte($plan_expired_at)) {
//                return $this::sendFailedResponse(__('Please renew your subscription plan'), direct: 'subscription_screen');

                if ($request->expectsJson()) {
                    return $this::sendFailedResponse(__('Please renew your subscription plan'), direct: 'subscription_screen');
                } else {
                    Auth::logout();

                    return redirect()->route('seller.login')->with('error', __('Please renew your subscription plan'));
                }
            }
        } else {
//            return $this::sendFailedResponse(__('Please Subscribe to subscription plan'), direct: 'subscription_screen');

            if ($request->expectsJson()) {
                return $this::sendFailedResponse(__('Please Subscribe to subscription plan'), direct: 'subscription_screen');
            } else {
                Auth::logout();
                //                    return $this::sendFailedResponse(__('Please Subscribe to subscription plan'), direct: 'subscription_screen');
                return redirect()->route('seller.login')->with('error', __('Please Subscribe to subscription plan'));
            }
        }

//        if (! is_null($user->plan_expired_at)) {
//            $plan_expired_at = Carbon::parse($user->plan_expired_at);
//            if (now()->gte($plan_expired_at)) {
//                if ($request->expectsJson()) {
//                    return $this::sendFailedResponse(__('Please renew your subscription plan'), direct: 'subscription_screen');
//                } else {
//                    Auth::logout();
//                    return redirect()->route('seller.login')->with('error', __('Please renew your subscription plan'));
//                }
//            }
//        } else {
//            return $this::sendFailedResponse(__('Please Subscribe to subscription plan'), direct: 'subscription_screen');
//        }

        return $next($request);
    }
}
