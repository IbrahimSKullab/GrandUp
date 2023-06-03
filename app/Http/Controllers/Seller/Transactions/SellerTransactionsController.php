<?php

namespace App\Http\Controllers\Seller\Transactions;

use Auth;
use Illuminate\Http\Request;
use App\Models\SellerTransaction;
use App\Http\Controllers\Controller;
use App\Datatables\SellerTransactionDatatables;

class SellerTransactionsController extends Controller
{
    public function __construct(
        private readonly SellerTransactionDatatables $sellerTransactionDatatables,
    ) {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->sellerTransactionDatatables->datatables($request);
        }

        return view('seller.pages.transactions.seller')->with([
            'columns' => $this->sellerTransactionDatatables::sellerColumns(),
        ]);
    }

    public function show($id)
    {
        $transaction = SellerTransaction::query()->where('seller_id', Auth::id())->findOrFail($id);

        return view('seller.pages.transactions.show')->with([
            'transaction' => $transaction,
            'type' => 'seller',
        ]);
    }
}
