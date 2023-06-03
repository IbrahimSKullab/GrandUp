<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\SellerViolation;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class SellerViolationDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'notes' => ['notes->ar'],
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('created_at', function (SellerViolation $sellerViolation) {
                return Helper::formatDate($sellerViolation->created_at);
            })
            ->addColumn('updated_at', function (SellerViolation $sellerViolation) {
                return Helper::formatDate($sellerViolation->updated_at);
            })
            ->addColumn('notes', function (SellerViolation $sellerViolation) {
                return $sellerViolation->notes;
            })
            ->addColumn('action', function (SellerViolation $sellerViolation) {
                return (new DataTableActions())
                    ->edit(route('admin.seller-violation.edit', $sellerViolation->id))
                    ->delete(route('admin.seller-violation.destroy', $sellerViolation->id))
                    ->make();
            })
            ->rawColumns(['action', 'image'])
            ->toJson();
    }

    public function query(Request $request)
    {
        return SellerViolation::query()
            ->latest()
            ->select('*');
    }
}
