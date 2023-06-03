<?php

namespace App\Datatables;

use App\Models\Admin;
use App\Helper\Helper;
use App\Enums\AdminEnum;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class PosDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'image',
            'name',
            'phone',
            'pos_current_points',
            'governorate' => ['governorate.title->ar'],
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
            ->addColumn('image', function (Admin $admin) {
                return DataTableActions::image($admin->getFirstMediaUrl(AdminEnum::POS_IMAGE->name));
            })
            ->addColumn('governorate', function (Admin $admin) {
                return $admin->governorate?->title;
            })
            ->addColumn('created_at', function (Admin $admin) {
                return Helper::formatDate($admin->created_at);
            })
            ->addColumn('updated_at', function (Admin $admin) {
                return Helper::formatDate($admin->updated_at);
            })
            ->addColumn('action', function (Admin $admin) {
                return (new DataTableActions())
                    ->edit(route('admin.pos.edit', $admin->id))
                    ->delete(route('admin.pos.destroy', $admin->id))
                    ->make();
            })
            ->rawColumns(['action', 'status', 'image'])
            ->make();
    }

    public function query(Request $request)
    {
        return Admin::query()
            ->where('is_staff', 0)
            ->where('is_agent', 0)
            ->where('is_pos', 1)
            ->with('governorate')
            ->latest()
            ->select('*');
    }
}
