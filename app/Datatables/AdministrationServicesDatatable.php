<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\AdministrationService;
use App\Models\SellerProduct;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class AdministrationServicesDatatable implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'title' => ['title->ar'],
            'point',
            'point_seller',
            'status',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (AdministrationService $administrationService) {
                if ($administrationService->status == 1) {
                    return "<span class='badge badge-success'>" . __('Accepted') . '</span>';
                }
                if ($administrationService->status == 0) {
                    return "<span class='badge badge-danger'>" . __('Rejected') . '</span>';
                }
            })
            ->addColumn('title', function (AdministrationService $administrationService) {
                return $administrationService->title;
            })
            ->addColumn('created_at', function (AdministrationService $administrationService) {
                return Helper::formatDate($administrationService->created_at);
            })
            ->addColumn('action', function (AdministrationService $administrationService) {
                return (new DataTableActions())
                    ->edit(route('admin.administration_services.edit', $administrationService->id))
//                    ->delete(route('admin.administration_services.destroy', $administrationService->id))
                    ->make();
            })
            ->rawColumns(['action', 'status', 'title'])
            ->make();
    }

    public function query(Request $request)
    {
        return AdministrationService::query()
            ->latest()
            ->select('*');
    }
}
