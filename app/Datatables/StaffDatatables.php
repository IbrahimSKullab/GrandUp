<?php

namespace App\Datatables;

use App\Models\Admin;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\Builder;

class StaffDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'user_profile_image',
            'name',
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables($request): JsonResponse
    {
        return datatables($this->query($request))
            ->addColumn('user_profile_image', function (Admin $admin) {
                return DataTableActions::image($admin->profile_image);
            })
            ->addColumn('action', function (Admin $admin) {
                return (new DataTableActions())
                    ->edit(route('admin.staff.edit', $admin->id))
                    ->delete(route('admin.staff.destroy', $admin->id))
                    ->make();
            })
            ->addColumn('status', function (Admin $admin) {
                return (new DataTableActions())
                    ->model($admin)
                    ->modelId($admin->id)
                    ->checkStatus($admin->status)
                    ->switcher();
            })
            ->addColumn('created_at', function (Admin $admin) {
                return $admin->created_at->format('Y-m-d');
            })
            ->addColumn('updated_at', function (Admin $admin) {
                return $admin->updated_at->format('Y-m-d');
            })
            ->rawColumns(['action', 'status', 'user_profile_image'])
            ->toJson(true);
    }

    public function query($request): Builder
    {
        return Admin::query()
            ->where('id', '!=', 1)
            ->where('is_staff', 1)
            ->where('is_pos', 0)
            ->where('is_agent', 0)
            ->select('*');
    }
}
