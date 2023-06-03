<?php

namespace App\Services\Order;

use DB;
use PDF;
use Exception;
use App\Models\Order;
use App\Enums\OrderEnum;
use App\Exports\ExportOrder;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\User\OrderAcceptedNotification;
use App\Notifications\User\OrderCanceledNotification;

class OrderServices
{
    public function findById($id)
    {
        return Order::query()->findOrFail($id);
    }

    public function exportExcelSheet($id)
    {
        $order = $this->findById($id);

        return Excel::download(new ExportOrder($order), $order->code . '.xlsx');
    }

    public function exportPDF($id)
    {
        $order = $this->findById($id);
        $pdf = PDF::loadView('order.pdf', ['order' => $order]);

        return $pdf->stream($order->code . '.pdf');
    }

    public function downloadPDF($id)
    {
        $order = $this->findById($id);
        $pdf = PDF::loadView('order.pdf', ['order' => $order]);

        return $pdf->stream($order->code . '.pdf');
    }

    public function updateStatus($id, $status)
    {
        return DB::transaction(function () use ($id, $status) {
            $order = $this->findById($id);

            $orderCurrentStatus = $order->status;

            if ($orderCurrentStatus == OrderEnum::COMPLETED->name) {
                throw new Exception(__('Order Status Cannot Be Change because it is already completed'));
            }

            if ($orderCurrentStatus == OrderEnum::CANCELED->name) {
                throw new Exception(__('Order Status Cannot Be Change because it is already canceled'));
            }

            $order->update([
                'status' => $status,
            ]);

            if ($status == OrderEnum::CANCELED->name) {
                $sellerCurrentPoints = $order->seller->current_points;
                $order->seller->update([
                    'current_points' => $sellerCurrentPoints + $order->points,
                ]);
            }

            if ($status == OrderEnum::COMPLETED->name && $order->points != 0) {
                $order->user->creditUserByOrderPoint($order->seller->id, $order->points);
            }

            if ($status == OrderEnum::COMPLETED->name) {
                $order->user->notify(new OrderAcceptedNotification($order));
            }

            if ($status == OrderEnum::CANCELED->name) {
                $order->user->notify(new OrderCanceledNotification($order));
            }
        });
    }
}
