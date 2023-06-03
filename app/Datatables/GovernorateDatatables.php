<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\StatusEnum;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class GovernorateDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'title' => ['title->ar'],
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (Governorate $governorate) {
                return (new DataTableActions())
                    ->model($governorate)
                    ->modelId($governorate->id)
                    ->checkStatus($governorate->status)
                    ->switcher();
            })
            ->addColumn('created_at', function (Governorate $governorate) {
                return Helper::formatDate($governorate->created_at);
            })
            ->addColumn('updated_at', function (Governorate $governorate) {
                return Helper::formatDate($governorate->updated_at);
            })
            ->addColumn('title', function (Governorate $governorate) {
                return $governorate->title;
            })
            ->addColumn('action', function (Governorate $governorate) {
                return (new DataTableActions())
                    ->edit(route('admin.governorate.edit', $governorate->id))
                    ->delete(route('admin.governorate.destroy', $governorate->id))
                    ->make();
            })
            ->rawColumns(['action', 'image', 'status'])
            ->toJson();
    }

    public function query(Request $request)
    {
        return Governorate::query()
            ->when($request->filled('status') && $request->status === StatusEnum::INACTIVE->value, function ($query) {
                $query->disabled();
            })
            ->latest()
            ->select('*');
    }
}
