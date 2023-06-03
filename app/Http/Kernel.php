<?php

namespace App\Http;

use App\Http\Middleware\CheckShippingCompanyAccountStatusMiddleware;
use App\Http\Middleware\TrimStrings;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\TrustProxies;
use App\Http\Middleware\EncryptCookies;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Auth\Middleware\Authorize;
use Illuminate\Http\Middleware\HandleCors;
use App\Http\Middleware\CheckUserMiddleware;
use App\Http\Middleware\CheckIsPosMiddleware;
use App\Http\Middleware\LanguageApiMiddleware;
use App\Http\Middleware\CheckIsAgentMiddleware;
use App\Http\Middleware\CheckIsStaffMiddleware;
use Illuminate\Auth\Middleware\RequirePassword;
use Illuminate\Http\Middleware\SetCacheHeaders;
use Illuminate\Session\Middleware\StartSession;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\GetCountryUserMiddleware;
use App\Http\Middleware\CheckAdminStatusMiddleware;
use Illuminate\Routing\Middleware\ThrottleRequests;
use App\Http\Middleware\CheckSellerStatusMiddleware;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Routing\Middleware\ValidateSignature;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use App\Http\Middleware\PreventRequestsDuringMaintenance;
use Illuminate\Auth\Middleware\AuthenticateWithBasicAuth;
use App\Http\Middleware\CheckSellerAccountStatusMiddleware;
use Illuminate\Foundation\Http\Middleware\ValidatePostSize;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;
use Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath;
use App\Http\Middleware\CheckSellerSubscriptionExpirationDateMiddleware;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        TrustProxies::class,
        HandleCors::class,
        PreventRequestsDuringMaintenance::class,
        ValidatePostSize::class,
        TrimStrings::class,
        ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'auth.basic' => AuthenticateWithBasicAuth::class,
        'auth.session' => AuthenticateSession::class,
        'cache.headers' => SetCacheHeaders::class,
        'can' => Authorize::class,
        'guest' => RedirectIfAuthenticated::class,
        'password.confirm' => RequirePassword::class,
        'signed' => ValidateSignature::class,
        'throttle' => ThrottleRequests::class,
        'verified' => EnsureEmailIsVerified::class,

        'check.user.account' => CheckUserMiddleware::class,
        'check.seller.account' => CheckSellerAccountStatusMiddleware::class,
        'check.seller.subscription.plan' => CheckSellerSubscriptionExpirationDateMiddleware::class,
        'check.shipping_company.account' => CheckShippingCompanyAccountStatusMiddleware::class,
        'api.lang' => LanguageApiMiddleware::class,

        'is_pos' => CheckIsPosMiddleware::class,
        'is_agent' => CheckIsAgentMiddleware::class,
        'is_staff' => CheckIsStaffMiddleware::class,
        'check.admin.status' => CheckAdminStatusMiddleware::class,
        'check.seller.status' => CheckSellerStatusMiddleware::class,
        'check.shipping_company.status' => CheckSellerStatusMiddleware::class,

        'localize' => LaravelLocalizationRoutes::class,
        'localizationRedirect' => LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect' => LocaleSessionRedirect::class,
        'localeCookieRedirect' => LocaleCookieRedirect::class,
        'localeViewPath' => LaravelLocalizationViewPath::class,
        'permission' => PermissionMiddleware::class,
        'country_user' => GetCountryUserMiddleware::class,


    ];
}
