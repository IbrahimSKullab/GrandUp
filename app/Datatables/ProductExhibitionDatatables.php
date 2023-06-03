<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\ProductExhibition;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class ProductExhibitionDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'seller' => ['seller.name'],
            'seller_type',
            'product' => ['product.title->ar'],
            'start_at',
            'end_at',
            'days',
            'points',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return DataTables::of($this->query($request))
            ->addColumn('seller', function (ProductExhibition $productOffer) {
                return $productOffer->seller->name;
            })
            ->addColumn('seller_type', function (ProductExhibition $productOffer) {
                return Helper::typeSeller($productOffer->seller_type);
            })
            ->addColumn('product', function (ProductExhibition $productOffer) {
                return $productOffer->product->title;
            })
            ->addColumn('start_at', function (ProductExhibition $productOffer) {
                return Helper::formatDate($productOffer->start_at, 'Y-m-d');
            })
            ->addColumn('end_at', function (ProductExhibition $productOffer) {
                return Helper::formatDate($productOffer->end_at, 'Y-m-d');
            })
            ->addColumn('created_at', function (ProductExhibition $productOffer) {
                return Helper::formatDate($productOffer->created_at);
            })
            ->addColumn('action', function (ProductExhibition $productOffer) {
                return (new DataTableActions())
                    ->show(route('admin.exhibition.show', $productOffer->id))
                    ->delete(route('admin.exhibition.destroy', $productOffer->id))
                    ->make();
            })
            ->rawColumns(['action', 'seller_type'])
            ->make();
    }

    public function query(Request $request)
    {
        return ProductExhibition::query()
            ->with(['seller', 'product'])
            ->latest('product_exhibitions.created_at')
            ->select('*');
    }
}
