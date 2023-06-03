<?php

namespace App\Http\Controllers\Seller\Dashboard;

use App\Models\Seller;
use Carbon\Carbon;
use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('seller.pages.dashboard.index')->with([
            'categories' => DB::table('categories')->count(),
            'subCategories' => DB::table('sub_categories')->count(),
            'products' => DB::table('seller_products')->where('seller_id', Auth::id())->count(),
            'orders' => DB::table('orders')->where('seller_id', Auth::id())->count(),
        ]);
    }

    public function updateDeviceToken(Request $request)
    {
        $this->validate($request, [
            'device_token' => 'required|string',
        ]);
        Auth::user()->update([
            'device_token' => $request->device_token,
        ]);

        return $this::sendSuccessResponse([], __('Device Token updated successfully'));
    }

    public function orderChart()
    {
        for ($i = 1; $i <= 12; $i++) {
            $year = now()->format('Y');
            $date_1 = Carbon::create($year, $i)->startOfMonth()->format('Y-m-d');
            $date_2 = Carbon::create($year, $i)->lastOfMonth()->format('Y-m-d');
            $counts[] = DB::table('orders')
                ->where('seller_id', Auth::id())
                ->whereDate('created_at', '>=', $date_1)
                ->whereDate('created_at', '<=', $date_2)
                ->count();
        }

        return $this::sendSuccessResponse([
            'counts' => $counts,
            'months' => collect(Helper::months())->values()->pluck('title')->values(),
        ], __('Data Retrieved Successfully'));
    }
}
