<?php

namespace App\Datatables;

use App\Enums\SellerEnum;
use App\Enums\ShippingEnum;
use App\Helper\Helper;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class ShippingCompanyDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'name',
            'phone',
            'account_status',
            'contact',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('created_at', function (ShippingCompany $shippingCompany) {
                return Helper::formatDate($shippingCompany->created_at);
            })
            ->addColumn('account_status', function (ShippingCompany $shippingCompany) {
                if ($shippingCompany->account_status == ShippingEnum::ACCEPTED->name) {
                    return "<div class='badge badge-success'>" . __('Accepted') . '</div>';
                }
                if ($shippingCompany->account_status == ShippingEnum::SUSPENDED->name) {
                    return "<div class='badge badge-danger'>" . __('Suspended') . '</div>';
                }
                if ($shippingCompany->account_status == ShippingEnum::REQUIRE_APPROVAL->name) {
                    return "<div class='badge badge-info'>" . __('Require approval') . '</div>';
                }
            })
            ->addColumn('contact', function (ShippingCompany $shippingCompany) {
                return "<button type='button' data-url='" . route('admin.shipping-company.send-notification', $shippingCompany->id) . "' data-bs-toggle='modal' data-bs-target='#notifications' class='btn btn-primary p-3 py-2 ms-2'><i class='far p-0 fa-bell'></i></button>";
            })
            ->addColumn('action', function (ShippingCompany $shippingCompany) {
                return (new DataTableActions())
                    ->edit(route('admin.shipping-company.edit', $shippingCompany->id))
                    ->delete(route('admin.shipping-company.destroy', $shippingCompany->id))
                    ->make();
            })
            ->rawColumns(['action', 'account_status', 'contact'])
            ->make();
    }

    public function query(Request $request)
    {
        return ShippingCompany::query()
            ->latest()
            ->select('shipping_companies.*');
    }
}
