<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Enums\GuardEnum;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected string $redirectTo = '/seller/dashboard';

    public function __construct()
    {
        $this->middleware('guest:' . GuardEnum::SELLER->value)->except('logout');
    }

    public function showLoginForm()
    {
        if (Auth::guard(GuardEnum::ADMIN->value)->check()) {
            Auth::guard(GuardEnum::ADMIN->value)->logout();
        }

        return view('seller.auth.login');
    }

    public function username()
    {
        return 'phone';
    }

    protected function guard()
    {
        return Auth::guard(GuardEnum::SELLER->value);
    }
}
