<?php

namespace App\Datatables;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use App\Models\NotificationRequest;
use Yajra\DataTables\Facades\DataTables;

class NotificationRequestDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'seller' => ['seller.name'],
            'product' => ['product.title->ar'],
            'number_of_notification',
            'date',
            'points',
            'status',
            'created_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('status', function (NotificationRequest $notificationRequest) {
                if ($notificationRequest->status == 'accepted') {
                    return "<span class='badge badge-success'>" . __('Accepted') . '</span>';
                }
                if ($notificationRequest->status == 'rejected') {
                    return "<span class='badge badge-danger'>" . __('Rejected') . '</span>';
                }

                return "<span class='badge badge-info'>" . __('Waiting Approval') . '</span>';
            })
            ->addColumn('seller', function (NotificationRequest $notificationRequest) {
                return $notificationRequest->seller->name;
            })
            ->addColumn('product', function (NotificationRequest $notificationRequest) {
                return $notificationRequest->product->title;
            })
            ->addColumn('date', function (NotificationRequest $notificationRequest) {
                return Helper::formatDate($notificationRequest->date);
            })
            ->addColumn('created_at', function (NotificationRequest $notificationRequest) {
                return Helper::formatDate($notificationRequest->created_at);
            })
            ->addColumn('action', function (NotificationRequest $notificationRequest) {
                return (new DataTableActions())
                    ->show(route('admin.notification-request.show', $notificationRequest->id))
                    ->delete(route('admin.notification-request.destroy', $notificationRequest->id))
                    ->make();
            })
            ->rawColumns(['action', 'status'])
            ->make();
    }

    public function query(Request $request)
    {
        return NotificationRequest::query()
            ->with(['seller', 'product'])
            ->latest()
            ->select('*');
    }
}
