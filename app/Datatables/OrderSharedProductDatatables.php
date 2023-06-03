<?php

namespace App\Datatables;


use App\Helper\Helper;
use App\Models\Seller;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use App\Models\SellerSharedProduct;
use Yajra\DataTables\Facades\DataTables;

class OrderSharedProductDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'seller' => ['sellerUser.name'],
            'product' => ['sellerProduct.title'],
            'status',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (SellerSharedProduct $seller_shared_product) {
                if ($seller_shared_product->status == 'accepted') {
                    return "<span class='badge badge-success'>" . __('Accepted') . '</span>';
                }
                if ($seller_shared_product->status == 'rejected') {
                    return "<span class='badge badge-danger'>" . __('Rejected') . '</span>';
                }

                return "<span class='badge badge-info'>" . __('Waiting Approval') . '</span>';
            })
            ->addColumn('seller', function (SellerSharedProduct $seller_shared_product) {
                return $seller_shared_product->sellerUser->name;
            })
            ->addColumn('product', function (SellerSharedProduct $seller_shared_product) {
                return $seller_shared_product->sellerProduct->title;
            })
            ->addColumn('created_at', function (SellerSharedProduct $seller_shared_product) {
                return Helper::formatDate($seller_shared_product->created_at);
            })
            ->addColumn('action', function (SellerSharedProduct $seller_shared_product) {
                return (new DataTableActions())
                    ->show(route('seller.order-shared-product.show', $seller_shared_product->id))
//                    ->delete(route('seller.order-shared-product.destroy', $seller_shared_product->id))
                    ->make();
            })
            ->rawColumns(['action', 'status', 'seller', 'product'])
            ->make();
    }

    public function query(Request $request)
    {
        return SellerSharedProduct::query()
            ->with(['sellerUser', 'sellerProduct'])
            ->latest()
            ->when($request->filled('status') && $request->status == StatusEnum::INACTIVE->value, function ($query) {
                $query->where('status', 'pending');
            })
            ->select('*');
    }

}
