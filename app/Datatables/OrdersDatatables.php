<?php

namespace App\Datatables;

use Auth;
use App\Models\Order;
use App\Helper\Helper;
use App\Enums\GuardEnum;
use App\Enums\OrderEnum;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class OrdersDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'code',
            'user' => ['user.name'],
            'seller' => ['seller.name'],
            'status',
            'total_cost',
            'total_qty',
            'points',
            'created_at',
        ];
    }

    public static function sellerColumns(): array
    {
        return [
            'code',
            'user' => ['user.name'],
            'status',
            'total_cost',
            'total_qty',
            'points',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('user', function (Order $order) {
                return $order->user->name;
            })
            ->addColumn('seller', function (Order $order) {
                return $order->seller->name;
            })
            ->addColumn('status', function (Order $order) {
                return $order->statusText();
            })
            ->addColumn('created_at', function (Order $order) {
                return Helper::formatDate($order->created_at);
            })
            ->addColumn('total_cost', function (Order $order) {
                return Helper::sellerPrice($order->total_cost_currency, $order->total_cost);
            })
            ->addColumn('action', function (Order $order) {
                if (Auth::guard(GuardEnum::SELLER->value)->check()) {
                    return (new DataTableActions())
                        ->show(route('seller.orders.show', [$order->id, 'status' => \request()->status]))
                        ->make();
                } else {
                    return (new DataTableActions())
                        ->show(route('admin.orders.show', [$order->id, 'status' => \request()->status]))
                        ->make();
                }
            })
            ->rawColumns(['action', 'status', 'image'])
            ->make();
    }

    public function query(Request $request)
    {
        return Order::query()
            ->with(['seller', 'user'])
            ->when($request->filled('status') && $request->status !== OrderEnum::ALL->name, function ($query) {
                $query->where('status', request()->status);
            })
            ->when($request->filled('seller_id') && $request->seller_id != '', function ($query) {
                $query->where('seller_id', request()->seller_id);
            })
            ->when(Auth::guard(GuardEnum::SELLER->value)->check(), function ($query) {
                $query->where('seller_id', Auth::id());
            })
            ->latest()
            ->select('orders.*');
    }
}
