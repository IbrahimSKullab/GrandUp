<?php

namespace App\Datatables;

use App\Helper\Helper;
use Illuminate\Http\Request;
use App\Models\NotificationTimes;
use App\Support\DataTableActions;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class NotificationTimesDatabases implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'title' => ['title->ar'],
            'number_of_notifications' => ['number_of_notifications'],
            'date',
            'is_reserved',
            'points' => ['points'],
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request): JsonResponse
    {
        return Datatables::of($this->query($request))
            ->addColumn('title', function (NotificationTimes $notificationTimes) {
                return $notificationTimes->title;
            })
            ->addColumn('created_at', function (NotificationTimes $notificationTimes) {
                return Helper::formatDate($notificationTimes->created_at);
            })
            ->addColumn('date', function (NotificationTimes $notificationTimes) {
                return Helper::formatDate($notificationTimes->date);
            })
            ->addColumn('is_reserved', function (NotificationTimes $notificationTimes) {
                return $notificationTimes->is_reserved ? (new DataTableActions)->color('green') : (new DataTableActions)->color('red');
            })
            ->addColumn('updated_at', function (NotificationTimes $notificationTimes) {
                return Helper::formatDate($notificationTimes->updated_at);
            })
            ->addColumn('action', function (NotificationTimes $notificationTimes) {
                return (new DataTableActions())
                    ->edit(route('admin.notification-times.edit', $notificationTimes->id))
                    ->delete(route('admin.notification-times.destroy', $notificationTimes->id))
                    ->make();
            })
            ->rawColumns(['action', 'status', 'is_reserved'])
            ->make();
    }

    public function query(Request $request)
    {
        return NotificationTimes::query()
            ->latest()
            ->select('*');
    }
}
