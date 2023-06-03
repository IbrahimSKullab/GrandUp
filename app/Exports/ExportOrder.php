<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportOrder implements FromView
{
    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function view(): View
    {
        return view('order.export', [
            'order' => $this->order,
        ]);
    }
}
