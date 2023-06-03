<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\GuardEnum;
use App\Enums\StatusEnum;
use App\Enums\ProductEnum;
use Illuminate\Http\Request;
use App\Models\SellerProduct;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'image',
            'title' => ['title->ar'],
            'seller' => ['seller.name'],
            'category' => ['category.title->ar'],
            'subCategory' => ['subCategory.title->ar'],
            'price',
            'special_price',
            'points',
            'status',
            'new_product',
            'admin_approval',
            'created_at',
        ];
    }

    public static function sellerColumns(): array
    {
        return [
            'image',
            'title' => ['title->ar'],
            'category' => ['category.title->ar'],
            'subCategory' => ['subCategory.title->ar'],
            'price',
            'special_price',
            'points',
            'status',
            'new_product',
            'admin_approval',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (SellerProduct $sellerProduct) {
                return (new DataTableActions())
                    ->model($sellerProduct)
                    ->modelId($sellerProduct->id)
                    ->checkStatus($sellerProduct->status)
                    ->switcher();
            })
            ->addColumn('admin_approval', function (SellerProduct $sellerProduct) {
                $status = '';
                if ($sellerProduct->admin_approval == 0 && $sellerProduct->product_rejected == 0) {
                    $status = "<span class='badge badge-info'>" . __('Waiting Approval') . '</span>';
                }
                if ($sellerProduct->admin_approval == 0 && $sellerProduct->product_rejected == 1) {
                    $status = "<span class='badge badge-danger'>" . __('Rejected') . '</span>';
                }
                if ($sellerProduct->admin_approval == 1 && $sellerProduct->product_rejected == 0) {
                    $status = "<span class='badge badge-success'>" . __('Approved') . '</span>';
                }
                if (Auth::guard(GuardEnum::SELLER->value)->check()) {
                    return $status;
                } else {
                    $images = [];

                    $images[] = $sellerProduct->image;
                    foreach ($sellerProduct->getMedia(ProductEnum::PRODUCT_IMAGES_COLLECTION->name) as $image) {
                        $images[] = $image->getUrl();
                    }

                    return '<a href="javascript:;"
                    data-bs-toggle="modal"
                    data-bs-target="#admin_approval_modal"
                    data-approval-link="' . route('admin.approve-product', $sellerProduct->id) . '"
                    data-reject-link="' . route('admin.reject-product', $sellerProduct->id) . '"
                    data-product-title="' . $sellerProduct->title . '"
                    data-product-description="' . $sellerProduct->description . '"
                    data-product-images=' . json_encode($images) . '
                    data-rejection-reason="' . $sellerProduct->rejection_reason . '">' . $status . '</a>';
                }
            })
            ->addColumn('new_product', function (SellerProduct $sellerProduct) {
                return (new DataTableActions())
                    ->model($sellerProduct)
                    ->modelId($sellerProduct->id)
                    ->column('new_product')
                    ->checkStatus($sellerProduct->new_product)
                    ->switcher();
            })
            ->addColumn('created_at', function (SellerProduct $sellerProduct) {
                return Helper::formatDate($sellerProduct->created_at);
            })
            ->addColumn('updated_at', function (SellerProduct $sellerProduct) {
                return Helper::formatDate($sellerProduct->updated_at);
            })
            ->addColumn('title', function (SellerProduct $sellerProduct) {
                return $sellerProduct->title;
            })
            ->addColumn('image', function (SellerProduct $sellerProduct) {
                return DataTableActions::image($sellerProduct->image);
            })
            ->addColumn('seller', function (SellerProduct $sellerProduct) {
                return $sellerProduct->seller->name;
            })
            ->addColumn('category', function (SellerProduct $sellerProduct) {
                return $sellerProduct->category?->title;
            })
            ->addColumn('subCategory', function (SellerProduct $sellerProduct) {
                return $sellerProduct->subCategory?->title;
            })
            ->addColumn('action', function (SellerProduct $sellerProduct) {
                if (Auth::guard(GuardEnum::SELLER->value)->check()) {
                    if ($sellerProduct->is_editable == 1) {
                        return (new DataTableActions())
                            ->show(route('seller.product.show', [$sellerProduct->id, 'status' => request()->status]))
                            ->edit(route('seller.product.edit', [$sellerProduct->id, 'status' => request()->status]))
                            ->delete(route('seller.product.destroy', $sellerProduct->id))
                            ->make();
                    } else {
                        return (new DataTableActions())
                            ->show(route('seller.product.show', [$sellerProduct->id, 'status' => request()->status]))
                            ->edit(route('seller.product.edit', [$sellerProduct->id, 'status' => request()->status]))
//                            ->delete(route('seller.product.destroy', $sellerProduct->id))
                            ->make();
                    }
                } else {
                    if ($sellerProduct->is_editable == 1) {
                        return (new DataTableActions())
                            ->show(route('admin.product.show', [$sellerProduct->id, 'status' => request()->status]))
                            ->edit(route('admin.product.edit', [$sellerProduct->id, 'status' => request()->status]))
                            ->delete(route('admin.product.destroy', $sellerProduct->id))
                            ->make();
                    } else {
                        return (new DataTableActions())
                            ->show(route('admin.product.show', [$sellerProduct->id, 'status' => request()->status]))
                            ->edit(route('admin.product.edit', [$sellerProduct->id, 'status' => request()->status]))
//                            ->delete(route('admin.product.destroy', $sellerProduct->id))
                            ->make();
                    }
                }
            })
            ->rawColumns(['action', 'status', 'image', 'new_product', 'admin_approval'])
            ->make();
    }

    public function query(Request $request)
    {
        return SellerProduct::query()
            ->with(['seller', 'category', 'subCategory'])
            ->when($request->filled('status') && $request->status == StatusEnum::INACTIVE->value, function ($query) {
                $query->where('admin_approval', 1)->where('status', 0);
            })
            ->when($request->filled('status') && $request->status == StatusEnum::ACTIVE->value, function ($query) {
                $query->where('admin_approval', 1)->where('status', 1);
            })
            ->when($request->filled('status') && $request->status == 'require_admin_approval', function ($query) {
                $query->where('product_rejected', 0)->where('admin_approval', 0);
            })
            ->when($request->filled('status') && $request->status == 'rejected', function ($query) {
                $query->where('product_rejected', 1);
            })
            ->when($request->filled('seller_id') && $request->seller_id != '', function ($query) {
                $query->where('seller_id', request()->seller_id);
            })
            ->when(Auth::guard(GuardEnum::SELLER->value)->check(), function ($query) {
                $query->where('seller_id', Auth::id());
            })
            ->when($request->filled('status') && $request->status == StatusEnum::MOST_POPULAR_PRODUCTS->value, function ($query) {
                $query->latest('popularity');
            })
            ->when($request->filled('status') && $request->status == 'newest', function ($query) {
                $query->latest('created_at');
            })
            ->when($request->status != 'most_popular_products' && $request->status != 'newest', function ($query) {
                $query->latest('seller_products.updated_at');
            })
            ->select('seller_products.*');
    }
}
