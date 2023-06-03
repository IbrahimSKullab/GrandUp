<?php

namespace App\Datatables;

use Carbon\Carbon;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Enums\TransactionEnum;
use App\Models\PosTransaction;
use App\Models\AgentTransaction;
use App\Models\SellerTransaction;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\Eloquent\Collection;

class AdminTransactionsDatatable implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'txn_id',
            'transaction_to',
            'admin',
            'points',
            'transaction_type',
            'to_phone',
            'created_at',
        ];
    }

    public static function get_property($collection, $prop)
    {
        if ($collection->pos) {
            return $collection->pos->$prop;
        } elseif ($collection->seller) {
            return $collection->seller->$prop;
        } elseif ($collection->agent) {
            return $collection->agent->$prop;
        } else {
            return '-';
        }
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('created_at', function ($transaction) {
                return Helper::formatDate($transaction->created_at);
            })
            ->addColumn('admin', function ($transaction) {
                return $transaction->admin?->name ?? '--';
            })
            ->addColumn('transaction_to', function ($transaction) {
                return $this->get_property($transaction, 'name');
            })
            ->addColumn('points', function ($transaction) {
                return '+' . $transaction->points;
            })
            ->addColumn('to_phone', function ($transaction) {
                return $this->get_property($transaction, 'phone');
            })
            ->addColumn('transaction_type', function ($transaction) {
                return Helper::TransactionTypeText($transaction->transaction_type);
            })
            ->addColumn('action', function ($transaction) {
                return;
            })
            ->rawColumns(['action', 'transaction_type', 'transaction_to'])
            ->make();
    }

    public function query(Request $request)
    {
        $pos = true;
        $agent = true;
        $seller = true;
        $posTransactions = new Collection();
        $agentTransactions = new Collection();
        $sellerTransactions = new Collection();

        if (isset($request->transaction_type) && $request->transaction_type != '') {
            $pos = false;
            $agent = false;
            $seller = false;
            if ($request->transaction_type == TransactionEnum::TRANSFER_POINT_TO_SELLER->name) {
                $seller = true;
            } elseif ($request->transaction_type == TransactionEnum::TRANSFER_POINT_TO_POS->name) {
                $pos = true;
            } elseif ($request->transaction_type == TransactionEnum::TRANSFER_POINT_TO_AGENT->name) {
                $agent = true;
            }
        }

        if ($pos) {
            $posTransactions = PosTransaction::query()
                ->with(['pos', 'admin'])
                ->where('point_added_by', 'admin')
                ->where('is_added_points', 1)
                ->when($request->filled('date_range') && $request->date_range != '', function ($query) {
                    $date = explode(' - ', request()->date_range);
                    $startDate = Carbon::parse($date[0])->startOfDay()->format('Y-m-d H:i:s');
                    $endDate = Carbon::parse($date[1])->endOfDay()->format('Y-m-d H:i:s');
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->latest()
                ->get();
        }

        if ($agent) {
            $agentTransactions = AgentTransaction::query()
                ->with(['agent', 'admin'])
                ->where('point_added_by', 'admin')
                ->where('is_added_points', 1)
                ->when($request->filled('date_range') && $request->date_range != '', function ($query) {
                    $date = explode(' - ', request()->date_range);
                    $startDate = Carbon::parse($date[0])->startOfDay()->format('Y-m-d H:i:s');
                    $endDate = Carbon::parse($date[1])->endOfDay()->format('Y-m-d H:i:s');
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->latest()
                ->get();
        }

        if ($seller) {
            $sellerTransactions = SellerTransaction::query()
                ->with(['seller', 'admin'])
                ->where('point_added_by', 'admin')
                ->where('is_added_points', 1)
                ->when($request->filled('date_range') && $request->date_range != '', function ($query) {
                    $date = explode(' - ', request()->date_range);
                    $startDate = Carbon::parse($date[0])->startOfDay()->format('Y-m-d H:i:s');
                    $endDate = Carbon::parse($date[1])->endOfDay()->format('Y-m-d H:i:s');
                    $query->whereBetween('created_at', [$startDate, $endDate]);
                })
                ->latest()
                ->get();
        }

        $results = collect($posTransactions)->merge($agentTransactions)->merge($sellerTransactions);

        return $results;
    }
}
