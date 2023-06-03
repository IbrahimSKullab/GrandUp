<?php

namespace App\Http\Controllers\POS\Transaction;

use Exception;
use Illuminate\Http\Request;
use App\Services\User\UserServices;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Seller\SellerServices;
use App\Datatables\PosTransactionDatatables;
use App\Http\Requests\POS\TransactionRequest;
use App\Services\Transaction\TransactionServices;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionServices      $transactionServices,
        private readonly PosTransactionDatatables $posTransactionDatatables,
        private readonly UserServices             $userServices,
        private readonly SellerServices           $sellerServices
    ) {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->posTransactionDatatables->datatables($request);
        }

        return view('admin.pos.transaction.index')->with([
            'columns' => $this->posTransactionDatatables::posColumns(),
        ]);
    }

    public function show($id)
    {
        $transaction = $this->transactionServices->findTransactionForPos(Auth::id(), $id);

        return view('admin.pos.transaction.show')->with([
            'transaction' => $transaction,
        ]);
    }

    public function store(TransactionRequest $request)
    {
        if ($request->integer('points') > Auth::user()->pos_current_points) {
            return back()->with('error', __('Your points is not enough'));
        }

        try {
            if ($request->type == 'seller') {
                $seller = $this->sellerServices->findByPhone($request->phone);
                $this->transactionServices->creditPointsToSellerByUsingPosPoints(Auth::id(), $request->points, $seller->id);
            } else {
                $user = $this->userServices->findByPhone($request->phone);
                $this->transactionServices->creditPointsToUserByUsingPosPoints(Auth::id(), $request->points, $user->id);
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Points Transferred Successfully'));
    }
}
