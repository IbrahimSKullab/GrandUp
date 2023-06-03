<?php

namespace App\Http\Controllers\Agent\Transaction;

use Log;
use Exception;
use Illuminate\Http\Request;
use App\Services\Pos\PosServices;
use App\Services\User\UserServices;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Seller\SellerServices;
use App\Datatables\AgentTransactionDatatables;
use App\Http\Requests\Agent\TransactionRequest;
use App\Services\Transaction\TransactionServices;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionServices        $transactionServices,
        private readonly AgentTransactionDatatables $agentTransactionDatatables,
        private readonly PosServices                $posServices,
        private readonly UserServices               $userServices,
        private readonly SellerServices             $sellerServices
    ) {
    }

    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return $this->agentTransactionDatatables->datatables($request);
        }

        return view('admin.agent.transaction.index')->with([
            'columns' => $this->agentTransactionDatatables::agentColumns(),
        ]);
    }

    public function show($id)
    {
        $transaction = $this->transactionServices->findTransactionForAgent(Auth::id(), $id);

        return view('admin.agent.transaction.show')->with([
            'transaction' => $transaction,
        ]);
    }

    public function store(TransactionRequest $request)
    {
        if ($request->integer('points') > Auth::user()->agent_current_points) {
            return back()->with('error', __('Your points is not enough'));
        }

        try {
            if ($request->type == 'pos') {
                $pos = $this->posServices->findByPhone($request->phone);
                $this->transactionServices->creditPointsToPOSByUsingAgentPoints(Auth::id(), $request->points, $pos->id);
            }
            if ($request->type == 'seller') {
                $seller = $this->sellerServices->findByPhone($request->phone);
                $this->transactionServices->creditPointsToSellerByUsingAgentPoints(Auth::id(), $request->points, $seller->id);
            }
            // if ($request->type == "user") {
            //     $user = $this->userServices->findByPhone($request->phone);
            //     $this->transactionServices->creditPointsToUserByUsingAgentPoints(Auth::id(), $request->points, $user->id);
            // }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return back()->withInput()->with('error', $exception->getMessage());
        }

        return back()->with('success', __('Points Transferred Successfully'));
    }
}
