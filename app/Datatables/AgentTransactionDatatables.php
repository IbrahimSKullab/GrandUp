<?php

namespace App\Datatables;

use Carbon\Carbon;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Models\AgentTransaction;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AgentTransactionDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'txn_id',
            'agent' => ['agent.name'],
            'admin' => ['admin.name'],
            'points' => ['points'],
            'transaction_type' => ['transaction_type'],
            'from_phone' => ['from_phone'],
            'to_phone' => ['to_phone'],
            'created_at',
        ];
    }

    public static function agentColumns(): array
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

            ->addColumn('created_at', function (AgentTransaction $agentTransaction) {
                return Helper::formatDate($agentTransaction->created_at);
            })
            ->addColumn('agent', function (AgentTransaction $agentTransaction) {
                return $agentTransaction->agent?->name;
            })
            ->addColumn('admin', function (AgentTransaction $agentTransaction) {
                return $agentTransaction->admin?->name ?? '--';
            })
            ->addColumn('points', function (AgentTransaction $agentTransaction) {
                if ($agentTransaction->is_added_points) {
                    return '+' . $agentTransaction->points;
                } else {
                    return '-' . $agentTransaction->points;
                }
            })
            ->addColumn('from_phone', function (AgentTransaction $agentTransaction) {
                if ($agentTransaction->credit_by_admin) {
                    return __('Transfer From Administration');
                } else {
                    return $agentTransaction->from_phone;
                }
            })
            ->addColumn('to_phone', function (AgentTransaction $agentTransaction) {
                return $agentTransaction->to_phone;
            })
            ->addColumn('transaction_type', function (AgentTransaction $agentTransaction) {
                return Helper::TransactionTypeText($agentTransaction->transaction_type);
            })
            ->addColumn('action', function (AgentTransaction $agentTransaction) {
                if (Auth::user()->is_agent) {
                    return (new DataTableActions())->show(route('admin.admin-agent.transaction.show', $agentTransaction->id))->make();
                } else {
                    return (new DataTableActions())->show(route('admin.agent-transactions.show', $agentTransaction->id))->make();
                }
            })
            ->rawColumns(['action', 'status', 'transaction_type'])

            ->rawColumns(['action', 'status', 'transaction_type'])
            ->make();
    }

    public function query(Request $request)
    {
        return AgentTransaction::query()
            ->with(['agent', 'admin'])
            ->when($request->filled('transaction_type') && $request->transaction_type != 'all', function ($query) {
                $query->where('transaction_type', request()->transaction_type);
            })
            ->when(Auth::user()->is_agent, function ($query) {
                return $query->where('agent_id', Auth::id());
            })
            ->when($request->filled('date_range') && $request->date_range != '', function ($query) {
                $date = explode(' - ', request()->date_range);
                $startDate = Carbon::parse($date[0])->startOfDay()->format('Y-m-d H:i:s');
                $endDate = Carbon::parse($date[1])->endOfDay()->format('Y-m-d H:i:s');
                $query->whereBetween('created_at', [$startDate, $endDate]);
            })
            ->latest()
            ->select('agent_transactions.*');
    }
}
