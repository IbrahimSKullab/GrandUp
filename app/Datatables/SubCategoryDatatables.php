<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\StatusEnum;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'title' => ['title->ar'],
            'category' => ['category.title->ar'],
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (SubCategory $subCategory) {
                return (new DataTableActions())
                    ->model($subCategory)
                    ->modelId($subCategory->id)
                    ->checkStatus($subCategory->status)
                    ->switcher();
            })
            ->addColumn('created_at', function (SubCategory $subCategory) {
                return Helper::formatDate($subCategory->created_at);
            })
            ->addColumn('category', function (SubCategory $subCategory) {
                return $subCategory->category->title;
            })
            ->addColumn('title', function (SubCategory $subCategory) {
                return $subCategory->title;
            })
            ->addColumn('updated_at', function (SubCategory $subCategory) {
                return Helper::formatDate($subCategory->updated_at);
            })
            ->addColumn('action', function (SubCategory $subCategory) {
                return (new DataTableActions())
                    ->edit(route('admin.sub-category.edit', $subCategory->id))
                    ->delete(route('admin.sub-category.destroy', $subCategory->id))
                    ->make();
            })
            ->rawColumns(['action', 'status', 'image'])
            ->make();
    }

    public function query(Request $request)
    {
        return SubCategory::query()
            ->with(['category'])
            ->when($request->filled('status') && $request->status == StatusEnum::INACTIVE->value, function ($query) {
                $query->where('status', 0);
            })
            ->latest()
            ->select('*');
    }
}
