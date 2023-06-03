<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\StatusEnum;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class AttributeDatatables implements DatatableInterface
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
            ->addColumn('status', function (Attribute $attribute) {
                return (new DataTableActions())
                    ->model($attribute)
                    ->modelId($attribute->id)
                    ->checkStatus($attribute->status)
                    ->switcher();
            })
            ->addColumn('created_at', function (Attribute $attribute) {
                return Helper::formatDate($attribute->created_at);
            })
            ->addColumn('updated_at', function (Attribute $attribute) {
                return Helper::formatDate($attribute->updated_at);
            })
            ->addColumn('title', function (Attribute $attribute) {
                return $attribute->title;
            })
            ->addColumn('action', function (Attribute $attribute) {
                return (new DataTableActions())
                    ->edit(route('admin.attribute.edit', $attribute->id))
                    ->delete(route('admin.attribute.destroy', $attribute->id))
                    ->make();
            })
            ->rawColumns(['action', 'image', 'status'])
            ->toJson();
    }

    public function query(Request $request)
    {
        return Attribute::query()
            ->when($request->filled('status') && $request->status === StatusEnum::INACTIVE->value, function ($query) {
                $query->disabled();
            })
            ->latest()
            ->select('*');
    }
}
