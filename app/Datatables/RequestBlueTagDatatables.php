<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Enums\StatusEnum;
use App\Models\BlueTag;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class RequestBlueTagDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'seller' => ['seller.name'],
            'status',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (BlueTag $blue_tag) {
                if ($blue_tag->status == 'accepted') {
                    return "<span class='badge badge-success'>" . __('Accepted') . '</span>';
                }
                if ($blue_tag->status == 'rejected') {
                    return "<span class='badge badge-danger'>" . __('Rejected') . '</span>';
                }

                return "<span class='badge badge-info'>" . __('Waiting Approval') . '</span>';
            })
            ->addColumn('seller', function (BlueTag $blue_tag) {
                return $blue_tag->seller->name;
            })
            ->addColumn('created_at', function (BlueTag $blue_tag) {
                return Helper::formatDate($blue_tag->created_at);
            })
            ->addColumn('action', function (BlueTag $blue_tag) {
                return (new DataTableActions())
                    ->show(route('admin.request-blue-tag.show', $blue_tag->id))
                    ->delete(route('admin.request-blue-tag.destroy', $blue_tag->id))
                    ->make();
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }

    public function query(Request $request)
    {
        return BlueTag::query()
            ->with(['seller'])
            ->latest()
            ->when($request->filled('status') && $request->status == StatusEnum::INACTIVE->value, function ($query) {
                $query->where('status', 'pending');
            })
            ->select('*');
    }
}
