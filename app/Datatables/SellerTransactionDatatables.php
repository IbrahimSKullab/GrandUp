<?php

namespace App\Datatables;

use Auth;
use Carbon\Carbon;
use App\Helper\Helper;
use App\Enums\GuardEnum;
use Illuminate\Http\Request;
use App\Enums\TransactionEnum;
use App\Models\SellerTransaction;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class SellerTransactionDatatables
{
    public static function columns(): array
    {
        return [
            'txn_id',
            'seller' => ['seller.name'],
            'admin' => ['admin.name'],
            'points' => ['points'],
            'transaction_type' => ['transaction_type'],
            'card_number' => ['card_number'],
            'from_phone' => ['from_phone'],
            'to_phone' => ['to_phone'],
            'created_at',
        ];
    }

    public static function sellerColumns(): array
    {
        return [
            'txn_id',
            'admin' => ['admin.name'],
            'points' => ['points'],
            'transaction_type' => ['transaction_type'],
            'card_number' => ['card_number'],
            'from_phone' => ['from_phone'],
            'to_phone' => ['to_phone'],
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('created_at', function (SellerTransaction $sellerTransaction) {
                return Helper::formatDate($sellerTransaction->created_at);
            })
            ->addColumn('seller', function (SellerTransaction $sellerTransaction) {
                return $sellerTransaction->seller->name;
            })
            ->addColumn('admin', function (SellerTransaction $sellerTransaction) {
                return $sellerTransaction->admin?->name ?? '--';
            })
            ->addColumn('card_number', function (SellerTransaction $sellerTransaction) {
                return $sellerTransaction->card_number ?? '--';
            })
            ->addColumn('points', function (SellerTransaction $sellerTransaction) {
                if ($sellerTransaction->is_added_points) {
                    return '+' . $sellerTransaction->points;
                } else {
                    return '-' . $sellerTransaction->points;
                }
            })
            ->addColumn('from_phone', function (SellerTransaction $sellerTransaction) {
                if ($sellerTransaction->transaction_type != TransactionEnum::POS_CREATING_CARDS->name) {
                    if ($sellerTransaction->point_added_by == 'admin') {
                        return __('Transfer From Administration');
                    } else {
                        return $sellerTransaction->from_phone;
                    }
                } else {
                    return '--';
                }
            })
            ->addColumn('to_phone', function (SellerTransaction $sellerTransaction) {
                if ($sellerTransaction->transaction_type != TransactionEnum::POS_CREATING_CARDS->name) {
                    return $sellerTransaction->to_phone;
                } else {
                    return '--';
                }
            })
            ->addColumn('transaction_type', function (SellerTransaction $sellerTransaction) {
                return Helper::TransactionTypeText($sellerTransaction->transaction_type);
            })
            ->addColumn('action', function (SellerTransaction $sellerTransaction) {
                if (Auth::guard(GuardEnum::SELLER->value)->check()) {
                    return (new DataTableActions())->show(route('seller.seller-transactions.show', $sellerTransaction->id))->make();
                } else {
                    return (new DataTableActions())->show(route('admin.seller-transactions.show', $sellerTransaction->id))->make();
                }
            })
            ->rawColumns(['action', 'status', 'transaction_type'])
            ->make();
    }

    public function query(Request $request)
    {
        return SellerTransaction::query()
            ->with(['seller', 'admin'])
            ->when($request->filled('transaction_type') && $request->transaction_type != 'all', function ($query) {
                $query->where('transaction_type', request()->transaction_type);
            })
            ->when($request->filled('seller_id') && $request->seller_id != '', function ($query) {
                $query->where('seller_id', request()->seller_id);
            })
            ->when($request->filled('date_range') && $request->date_range != '', function ($query) {
                $date = explode(' - ', request()->date_range);
                $startDate = Carbon::parse($date[0])->startOfDay()->format('Y-m-d H:i:s');
                $endDate = Carbon::parse($date[1])->endOfDay()->format('Y-m-d H:i:s');
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->when(Auth::guard(GuardEnum::SELLER->value)->check(), function ($query) {
                $query->where('seller_id', Auth::id());
            })
            ->latest()
            ->select('seller_transactions.*');
    }
}
