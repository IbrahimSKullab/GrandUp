<?php

namespace App\Datatables;

use Auth;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Enums\TransactionEnum;
use App\Models\PosTransaction;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class PosTransactionDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'txn_id',
            'pos' => ['pos.name'],
            'admin' => ['admin.name'],
            'points' => ['points'],
            'transaction_type' => ['transaction_type'],
            'from_phone' => ['from_phone'],
            'to_phone' => ['to_phone'],
            'created_at',
        ];
    }

    public static function posColumns(): array
    {
        return [
            'txn_id',
            'admin' => ['admin.name'],
            'points' => ['points'],
            'transaction_type' => ['transaction_type'],
            'from_phone' => ['from_phone'],
            'to_phone' => ['to_phone'],
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('created_at', function (PosTransaction $posTransaction) {
                return Helper::formatDate($posTransaction->created_at);
            })
            ->addColumn('pos', function (PosTransaction $posTransaction) {
                return $posTransaction->pos?->name;
            })
            ->addColumn('admin', function (PosTransaction $posTransaction) {
                return $posTransaction->admin?->name ?? '--';
            })
            ->addColumn('points', function (PosTransaction $posTransaction) {
                if ($posTransaction->is_added_points) {
                    return '+' . $posTransaction->points;
                } else {
                    return '-' . $posTransaction->points;
                }
            })
            ->addColumn('from_phone', function (PosTransaction $posTransaction) {
                if ($posTransaction->transaction_type != TransactionEnum::POS_CREATING_CARDS->name) {
                    if ($posTransaction->credit_by_admin) {
                        return __('Transfer From Administration');
                    } else {
                        return $posTransaction->from_phone;
                    }
                } else {
                    return '--';
                }
            })
            ->addColumn('to_phone', function (PosTransaction $posTransaction) {
                if ($posTransaction->transaction_type != TransactionEnum::POS_CREATING_CARDS->name) {
                    return $posTransaction->to_phone;
                } else {
                    return '--';
                }
            })
            ->addColumn('transaction_type', function (PosTransaction $posTransaction) {
                return Helper::TransactionTypeText($posTransaction->transaction_type);
            })
            ->addColumn('action', function (PosTransaction $posTransaction) {
                if (Auth::user()->is_pos) {
                    return (new DataTableActions())->show(route('admin.admin-pos.transaction.show', $posTransaction->id))->make();
                } else {
                    return (new DataTableActions())->show(route('admin.pos-transactions.show', $posTransaction->id))->make();
                }
            })
            ->rawColumns(['action', 'status', 'transaction_type'])
            ->make();
    }

    public function query(Request $request)
    {
        return PosTransaction::query()
            ->with(['pos', 'admin'])
            ->when($request->filled('transaction_type') && $request->transaction_type != 'all', function ($query) {
                $query->where('transaction_type', request()->transaction_type);
            })
            ->when(Auth::user()->is_pos, function ($query) {
                return $query->where('pos_id', Auth::id());
            })
            ->latest()
            ->select('pos_transactions.*');
    }
}
