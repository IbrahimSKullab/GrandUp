<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\StatusEnum;
use App\Models\RequestNumberSpecial;
use Illuminate\Http\Request;
use App\Models\ProductAdsSlider;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class RequestNumberSpecialDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'seller' => ['seller.name'],
            'number',
            'status',
//            'points',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (RequestNumberSpecial $requestNumberSpecial) {
                if ($requestNumberSpecial->status == 'accepted') {
                    return "<span class='badge badge-success'>" . __('Accepted') . '</span>';
                }
                if ($requestNumberSpecial->status == 'rejected') {
                    return "<span class='badge badge-danger'>" . __('Rejected') . '</span>';
                }

                return "<span class='badge badge-info'>" . __('Waiting Approval') . '</span>';
            })
            ->addColumn('seller', function (RequestNumberSpecial $requestNumberSpecial) {
                return $requestNumberSpecial->seller->name;
            })
            ->addColumn('created_at', function (RequestNumberSpecial $requestNumberSpecial) {
                return Helper::formatDate($requestNumberSpecial->created_at);
            })
            ->addColumn('action', function (RequestNumberSpecial $requestNumberSpecial) {
                return (new DataTableActions())
                    ->show(route('admin.request-number-special.show', $requestNumberSpecial->id))
                    ->delete(route('admin.request-number-special.destroy', $requestNumberSpecial->id))
                    ->make();
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }

    public function query(Request $request)
    {
        return RequestNumberSpecial::query()
            ->with(['seller'])
            ->latest()
            ->when($request->filled('status') && $request->status == StatusEnum::INACTIVE->value, function ($query) {
                $query->where('status', 'pending');
            })
            ->select('*');
    }
}
