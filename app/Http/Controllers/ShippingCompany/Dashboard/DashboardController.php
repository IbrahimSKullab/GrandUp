<?php

namespace App\Http\Controllers\ShippingCompany\Dashboard;

use Carbon\Carbon;
use App\Models\Order;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
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
        $shipping_company = ShippingCompany::withCount(['orders', 'deliveries'])->findOrFail(auth()->user()->id);

        $current_points_count = $shipping_company->current_points;
        $orders_count = $shipping_company->orders_count;
        $deliveries_count = $shipping_company->deliveries_count;

        return view('shipping-company.pages.dashboard.index', get_defined_vars());
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
                ->where('shipping_company_id', Auth::id())
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
