<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\Category;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class CategoryDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'image',
            'title' => ['title->ar'],
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (Category $category) {
                return (new DataTableActions())
                    ->model($category)
                    ->modelId($category->id)
                    ->checkStatus($category->status)
                    ->switcher();
            })
            ->addColumn('created_at', function (Category $category) {
                return Helper::formatDate($category->created_at);
            })
            ->addColumn('image', function (Category $category) {
                return DataTableActions::image($category->image);
            })
            ->addColumn('title', function (Category $category) {
                return $category->title;
            })
            ->addColumn('updated_at', function (Category $category) {
                return Helper::formatDate($category->updated_at);
            })
            ->addColumn('action', function (Category $category) {
                return (new DataTableActions())
                    ->edit(route('admin.category.edit', $category->id))
                    ->delete(route('admin.category.destroy', $category->id))
                    ->make();
            })
            ->rawColumns(['action', 'status', 'image'])
            ->make();
    }

    public function query(Request $request)
    {
        return Category::query()
            ->when($request->filled('status') && $request->status == StatusEnum::INACTIVE->value, function ($query) {
                $query->where('status', 0);
            })
            ->latest()
            ->select('*');
    }
}
