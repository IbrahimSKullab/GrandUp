<?php

namespace App\Datatables;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Models\DeliveryRates;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class DeliveryRateDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'country',
            'type',
            'price',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('country', function (DeliveryRates $delivery_rates) {
                return $delivery_rates->country?->title;
            })
            ->addColumn('type', function (DeliveryRates $delivery_rates) {
                return Helper::typeDeliveryRate($delivery_rates->type);
            })
            ->addColumn('created_at', function (DeliveryRates $delivery_rates) {
                return Helper::formatDate($delivery_rates->created_at);
            })
            ->addColumn('updated_at', function (DeliveryRates $delivery_rates) {
                return Helper::formatDate($delivery_rates->updated_at);
            })
            ->addColumn('action', function (DeliveryRates $delivery_rates) {
                return (new DataTableActions())
                    ->edit(route('admin.delivery_rates.edit', $delivery_rates->id))
                    ->delete(route('admin.delivery_rates.destroy', $delivery_rates->id))
                    ->make();
            })
            ->rawColumns(['action', 'image', 'status'])
            ->toJson();
    }

    public function query(Request $request)
    {
        return DeliveryRates::query()->latest()->select('*');
    }
}
