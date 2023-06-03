<?php

namespace App\Http\Controllers\API\V1\User\Transaction;

use Auth;
use App\Http\Controllers\Controller;
use App\Services\Transaction\TransactionServices;
use App\Http\Resources\Transaction\TransactionResource;

class TransactionController extends Controller
{
    public function __construct(private readonly TransactionServices $transactionServices)
    {
    }

    public function index()
    {
        $transactions = $this->transactionServices->getUserTransactions(Auth::id());

        return $this::sendSuccessResponse([
            'count' => $this->transactionServices->getUserTransactionsCount(Auth::id()),
            'data' => TransactionResource::collection($transactions),
        ]);
    }

    public function show($id)
    {
        $transaction = $this->transactionServices->findUserTransaction(Auth::id(), $id);

        return $this::sendSuccessResponse(TransactionResource::make($transaction));
    }
}
