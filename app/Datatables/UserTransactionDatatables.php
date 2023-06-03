<?php

namespace App\Datatables;

use Carbon\Carbon;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Enums\TransactionEnum;
use App\Models\UserTransaction;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class UserTransactionDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'txn_id',
            'user' => ['user.name'],
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
            ->addColumn('created_at', function (UserTransaction $userTransaction) {
                return Helper::formatDate($userTransaction->created_at);
            })
            ->addColumn('user', function (UserTransaction $userTransaction) {
                return $userTransaction->user->name . ' ' . $userTransaction->user->last_name;
            })
            ->addColumn('admin', function (UserTransaction $userTransaction) {
                return $userTransaction->admin?->name ?? '--';
            })
            ->addColumn('card_number', function (UserTransaction $userTransaction) {
                return $userTransaction->card_number ?? '--';
            })
            ->addColumn('points', function (UserTransaction $transaction) {
                if ($transaction->is_added_points) {
                    return '+' . $transaction->points;
                } else {
                    return '-' . $transaction->points;
                }
            })
            ->addColumn('from_phone', function (UserTransaction $transaction) {
                if ($transaction->transaction_type != TransactionEnum::POS_CREATING_CARDS->name) {
                    if ($transaction->point_added_by == 'admin') {
                        return __('Transfer From Administration');
                    } else {
                        return $transaction->from_phone;
                    }
                } else {
                    return '--';
                }
            })
            ->addColumn('to_phone', function (UserTransaction $transaction) {
                if ($transaction->transaction_type != TransactionEnum::POS_CREATING_CARDS->name) {
                    return $transaction->to_phone;
                } else {
                    return '--';
                }
            })
            ->addColumn('transaction_type', function (UserTransaction $transaction) {
                return Helper::TransactionTypeText($transaction->transaction_type);
            })
            ->addColumn('action', function (UserTransaction $transaction) {
                return (new DataTableActions())->show(route('admin.user-transactions.show', $transaction->id))->make();
            })
            ->rawColumns(['action', 'status', 'transaction_type'])
            ->make();
    }

    public function query(Request $request)
    {
        return UserTransaction::query()
            ->with(['user', 'admin'])
            ->when($request->filled('transaction_type') && $request->transaction_type != 'all', function ($query) {
                $query->where('transaction_type', request()->transaction_type);
            })
            ->when($request->filled('date_range') && $request->date_range != '', function ($query) {
                $date = explode(' - ', request()->date_range);
                $startDate = Carbon::parse($date[0])->startOfDay()->format('Y-m-d H:i:s');
                $endDate = Carbon::parse($date[1])->endOfDay()->format('Y-m-d H:i:s');
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->latest()
            ->select('user_transactions.*');
    }
}
