<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\StatusEnum;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class CurrencyDatatables implements DatatableInterface
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
            ->addColumn('status', function (Currency $currency) {
                return (new DataTableActions())
                    ->model($currency)
                    ->modelId($currency->id)
                    ->checkStatus($currency->status)
                    ->switcher();
            })
            ->addColumn('created_at', function (Currency $currency) {
                return Helper::formatDate($currency->created_at);
            })
            ->addColumn('updated_at', function (Currency $currency) {
                return Helper::formatDate($currency->updated_at);
            })
            ->addColumn('title', function (Currency $currency) {
                return $currency->title;
            })
            ->addColumn('action', function (Currency $currency) {
                return (new DataTableActions())
                    ->edit(route('admin.currency.edit', $currency->id))
                    ->delete(route('admin.currency.destroy', $currency->id))
                    ->make();
            })
            ->rawColumns(['action', 'image', 'status'])
            ->toJson();
    }

    public function query(Request $request)
    {
        return Currency::query()
            ->when($request->filled('status') && $request->status === StatusEnum::INACTIVE->value, function ($query) {
                $query->disabled();
            })
            ->latest()
            ->select('*');
    }
}
