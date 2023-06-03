<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\GiftOrder;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;

class GiftOrdersDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'order_code' => ['order_code'],
            'user' => ['user.name'],
            'userPhone' => ['user.phone'],
            'total_points',
            'total_qty',
            'status',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (GiftOrder $giftOrder) {
                if ($giftOrder->status == 'pending') {
                    return "<span class='badge badge-primary'>" . __('Pending') . '</span>';
                }
                if ($giftOrder->status == 'completed') {
                    return "<span class='badge badge-success'>" . __('Completed') . '</span>';
                }
                if ($giftOrder->status == 'rejected') {
                    return "<span class='badge badge-danger'>" . __('Rejected') . '</span>';
                }
            })
            ->addColumn('user', function (GiftOrder $giftOrder) {
                return $giftOrder->user->name;
            })
            ->addColumn('userPhone', function (GiftOrder $giftOrder) {
                return $giftOrder->user->phone;
            })
            ->addColumn('created_at', function (GiftOrder $giftOrder) {
                return Helper::formatDate($giftOrder->created_at);
            })
            ->addColumn('action', function (GiftOrder $giftOrder) {
                return (new DataTableActions())
                    ->show(route('admin.gift-order.show', $giftOrder->id))
                    ->make();
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }

    public function query(Request $request)
    {
        return GiftOrder::query()
            ->latest()
            ->with('user')
            ->when($request->filled('status') && $request->status != '', function ($query) {
                return $query->where('status', \request()->status);
            })
            ->select('*');
    }
}
