<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\StatusEnum;
use App\Models\ProductExhibition;
use Illuminate\Http\Request;
use App\Models\ProductAdsSlider;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class SliderDatatables implements DatatableInterface
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
            'status',
            'points',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (ProductAdsSlider $productAdsSlider) {
                if ($productAdsSlider->status == 'accepted') {
                    return "<span class='badge badge-success'>" . __('Accepted') . '</span>';
                }
                if ($productAdsSlider->status == 'rejected') {
                    return "<span class='badge badge-danger'>" . __('Rejected') . '</span>';
                }

                return "<span class='badge badge-info'>" . __('Waiting Approval') . '</span>';
            })
            ->addColumn('seller_type', function (ProductAdsSlider $productAdsSlider) {
                return Helper::typeSeller($productAdsSlider->seller_type);
            })
            ->addColumn('seller', function (ProductAdsSlider $productAdsSlider) {
                return $productAdsSlider->seller->name;
            })
            ->addColumn('product', function (ProductAdsSlider $productAdsSlider) {
                return $productAdsSlider->product->title;
            })
            ->addColumn('start_at', function (ProductAdsSlider $productAdsSlider) {
                return Helper::formatDate($productAdsSlider->start_at, 'Y-m-d');
            })
            ->addColumn('end_at', function (ProductAdsSlider $productAdsSlider) {
                return Helper::formatDate($productAdsSlider->end_at, 'Y-m-d');
            })
            ->addColumn('created_at', function (ProductAdsSlider $productAdsSlider) {
                return Helper::formatDate($productAdsSlider->created_at);
            })
            ->addColumn('action', function (ProductAdsSlider $productAdsSlider) {
                return (new DataTableActions())
                    ->show(route('admin.slider.show', $productAdsSlider->id))
                    ->delete(route('admin.slider.destroy', $productAdsSlider->id))
                    ->make();
            })
            ->rawColumns(['action', 'status', 'seller_type'])
            ->make();
    }

    public function query(Request $request)
    {
        return ProductAdsSlider::query()
            ->with(['seller', 'product'])
            ->latest()
            ->when($request->filled('status') && $request->status == StatusEnum::INACTIVE->value, function ($query) {
                $query->where('status', 'pending');
            })
            ->select('*');
    }
}
