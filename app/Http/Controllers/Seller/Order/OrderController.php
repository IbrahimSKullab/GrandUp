<?php

namespace App\Http\Controllers\Seller\Order;

use Log;
use Exception;
use App\Enums\OrderEnum;
use Illuminate\Http\Request;
use App\Datatables\OrdersDatatables;
use App\Http\Controllers\Controller;
use App\Services\Order\SellerOrderServices;

class OrderController extends Controller
{
    public function __construct(
        private readonly OrdersDatatables    $ordersDatatables,
        private readonly SellerOrderServices $sellerOrderServices
    ) {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->ordersDatatables->datatables($request);
        }

        return view('seller.pages.orders.index')->with([
            'columns' => $this->ordersDatatables::sellerColumns(),
        ]);
    }

    public function show($id)
    {
        $order = $this->sellerOrderServices->findById($id);

        return view('seller.pages.orders.show')->with([
            'order' => $order,
        ]);
    }

    public function exportExcel($id)
    {
        return $this->sellerOrderServices->exportExcelSheet($id);
    }

    public function exportPdf($id)
    {
        return $this->sellerOrderServices->exportPDF($id, true);
    }

    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|in:' .
                OrderEnum::NEW_ORDER->name .
                ',' . OrderEnum::COMPLETED->name .
                ',' . OrderEnum::IN_REVIEW->name .
                ',' . OrderEnum::CANCELED->name,
        ]);

        try {
            $this->sellerOrderServices->updateStatus($id, $request->status);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Status Updated Successfully'));
    }
}
