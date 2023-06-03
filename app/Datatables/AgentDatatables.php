<?php

namespace App\Datatables;

use App\Models\Admin;
use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class AgentDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'name' => ['name'],
            'phone' => ['phone'],
            'agent_current_points',
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (Admin $admin) {
                return (new DataTableActions())
                    ->model($admin)
                    ->modelId($admin->id)
                    ->checkStatus($admin->status)
                    ->switcher();
            })
            ->addColumn('created_at', function (Admin $admin) {
                return Helper::formatDate($admin->created_at);
            })
            ->addColumn('updated_at', function (Admin $admin) {
                return Helper::formatDate($admin->updated_at);
            })
            ->addColumn('action', function (Admin $admin) {
                return (new DataTableActions())
                    ->edit(route('admin.agent.edit', $admin->id))
                    ->delete(route('admin.agent.destroy', $admin->id))
                    ->make();
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }

    public function query(Request $request)
    {
        return Admin::query()
            ->where('is_staff', 0)
            ->where('is_pos', 0)
            ->where('is_agent', 1)
            ->latest()
            ->select('*');
    }
}
