<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\StatusEnum;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use App\Models\UploadProductRequest;
use Yajra\DataTables\Facades\DataTables;

class UploadProductRequestDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'seller' => ['seller.name'],
            'sellerPhone' => ['seller.phone'],
            'points',
            'status',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('created_at', function (UploadProductRequest $uploadProductRequest) {
                return Helper::formatDate($uploadProductRequest->created_at);
            })
            ->addColumn('seller', function (UploadProductRequest $uploadProductRequest) {
                return $uploadProductRequest->seller->name;
            })
            ->addColumn('sellerPhone', function (UploadProductRequest $uploadProductRequest) {
                return $uploadProductRequest->seller->phone;
            })
            ->addColumn('status', function (UploadProductRequest $uploadProductRequest) {
                return $uploadProductRequest->status == 'completed' ? __('Completed') : __('Pending');
            })
            ->addColumn('action', function (UploadProductRequest $uploadProductRequest) {
                return (new DataTableActions())
                    ->show(route('admin.upload-product.show', $uploadProductRequest->id))
                    ->delete(route('admin.upload-product.destroy', $uploadProductRequest->id))
                    ->make();
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function query(Request $request)
    {
        return UploadProductRequest::query()
            ->with('seller')
            ->when($request->filled('status') && $request->status == StatusEnum::INACTIVE->value, function ($query) {
                $query->where('status', 'pending');
            })
            ->latest()
            ->select('upload_product_requests.*');
    }
}
