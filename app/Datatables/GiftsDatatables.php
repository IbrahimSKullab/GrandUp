<?php

namespace App\Datatables;

use App\Models\Gift;
use App\Helper\Helper;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class GiftsDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'image',
            'title' => ['title->ar'],
            'points' => ['points'],
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('image', function (Gift $gift) {
                return DataTableActions::image($gift->image);
            })
            ->addColumn('title', function (Gift $gift) {
                return $gift->title;
            })
            ->addColumn('status', function (Gift $gift) {
                return (new DataTableActions())
                    ->model($gift)
                    ->modelId($gift->id)
                    ->checkStatus($gift->status)
                    ->switcher();
            })
            ->addColumn('created_at', function (Gift $gift) {
                return Helper::formatDate($gift->created_at);
            })
            ->addColumn('updated_at', function (Gift $gift) {
                return Helper::formatDate($gift->updated_at);
            })
            ->addColumn('action', function (Gift $gift) {
                return (new DataTableActions())
                    ->edit(route('admin.gifts.edit', $gift->id))
                    ->delete(route('admin.gifts.destroy', $gift->id))
                    ->make();
            })
            ->rawColumns(['action', 'status', 'image'])
            ->make();
    }

    public function query(Request $request)
    {
        return Gift::query()
            ->when($request->filled('status') && $request->status === StatusEnum::INACTIVE->value, function ($query) {
                $query->disabled();
            })
            ->latest()
            ->select('*');
    }
}
