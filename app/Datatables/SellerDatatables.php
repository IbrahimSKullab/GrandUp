<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\Seller;
use App\Enums\SellerEnum;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Yajra\DataTables\Facades\DataTables;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SellerDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'profile_image',
            'name' => ['name'],
            'order' => ['order'],
            'phone' => ['phone'],
            'current_points',
            'store_number',
            'country' => ['country.title->' . LaravelLocalization::getCurrentLocale()],
            'governorate' => ['governorate.title->' . LaravelLocalization::getCurrentLocale()],
            'contact',
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn('profile_image', function (Seller $seller) {
                return DataTableActions::image($seller->profile_image);
            })
            ->addColumn('governorate', function (Seller $seller) {
                return $seller->governorate?->title;
            })
            ->addColumn('country', function (Seller $seller) {
                return $seller->country?->title;
            })
            ->addColumn('created_at', function (Seller $seller) {
                return Helper::formatDate($seller->created_at);
            })
            ->addColumn('updated_at', function (Seller $seller) {
                return Helper::formatDate($seller->updated_at);
            })
            ->addColumn('status', function (Seller $seller) {
                if ($seller->account_status == SellerEnum::ACCEPTED->name) {
                    return "<div class='badge badge-success'>" . __('Accepted') . '</div>';
                }
                if ($seller->account_status == SellerEnum::SUSPENDED->name) {
                    return "<div class='badge badge-danger'>" . __('Suspended') . '</div>';
                }
                if ($seller->account_status == SellerEnum::REQUIRE_APPROVAL->name) {
                    return "<div class='badge badge-info'>" . __('Require approval') . '</div>';
                }
            })
            ->addColumn('action', function (Seller $seller) {
                return (new DataTableActions())
                    ->edit(route('admin.seller.edit', $seller->id))
                    ->show(route('admin.seller.show', $seller->id))
                    ->delete(route('admin.seller.destroy', $seller->id))
                    ->make();
            })
            ->addColumn('contact', function (Seller $seller) {
                $html = "<button type='button' onclick=window.open('https://wa.me/" . $seller->phone . "/?text=','_blank') class='btn p-3 py-2 btn-success'><i class='fab fa-whatsapp p-0'></i></button>";
                $html .= "<button type='button' data-url='" . route('admin.seller.send-notification', $seller->id) . "' data-bs-toggle='modal' data-bs-target='#notifications' class='btn btn-primary p-3 py-2 ms-2'><i class='far p-0 fa-bell'></i></button>";

                return $html;
            })
            ->rawColumns(['action', 'status', 'profile_image', 'contact'])
            ->make();
    }

    public function query(Request $request)
    {
        return Seller::query()
            ->with('governorate')
            ->with('country')
            ->when($request->filled('status') && $request->status == SellerEnum::ACCEPTED->name, function ($query) use ($request) {
                return $query->where('account_status', SellerEnum::ACCEPTED->name);
            })
            ->when($request->filled('status') && $request->status == SellerEnum::SUSPENDED->name, function ($query) use ($request) {
                return $query->where('account_status', SellerEnum::SUSPENDED->name);
            })
            ->when($request->filled('status') && $request->status == SellerEnum::REQUIRE_APPROVAL->name, function ($query) use ($request) {
                return $query->where('account_status', SellerEnum::REQUIRE_APPROVAL->name);
            })
            ->latest()
            ->select('sellers.*');
    }
}
