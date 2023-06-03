<?php

namespace App\Http\Controllers\API\V1\ShippingCompany;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Transaction\TransactionServices;
use App\Http\Resources\Transaction\TransactionResource;

class TransactionController extends Controller
{
    public function __construct(private TransactionServices $transactionServices)
    {
    }

    public function index()
    {
        $transactions = $this->transactionServices->getShippingTransactions(Auth::id());

        return $this::sendSuccessResponse([
            'count' => $this->transactionServices->getShippingTransactionsCount(Auth::id()),
            'data' => TransactionResource::collection($transactions),
        ]);
    }

    public function show($id)
    {
        $transaction = $this->transactionServices->findShippingTransaction(Auth::id(), $id);

        return $this::sendSuccessResponse(TransactionResource::make($transaction));
    }
}
