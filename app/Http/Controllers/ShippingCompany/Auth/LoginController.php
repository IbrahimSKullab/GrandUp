<?php

namespace App\Http\Controllers\ShippingCompany\Auth;

use App\Enums\GuardEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = '/shipping-company/dashboard';

    public function __construct()
    {
        $this->middleware('guest:' . GuardEnum::SHIPPING_COMPANY->value)->except('logout');
    }

    public function showLoginForm()
    {
//        if (Auth::guard(GuardEnum::ADMIN->value)->check()) {
//            Auth::guard(GuardEnum::ADMIN->value)->logout();
//        }

        return view('shipping-company.auth.login');
    }

    public function username()
    {
        return 'phone';
    }

    protected function guard()
    {
        return Auth::guard(GuardEnum::SHIPPING_COMPANY->value);
    }
}
