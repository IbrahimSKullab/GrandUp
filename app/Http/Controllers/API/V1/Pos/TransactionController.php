<?php

namespace App\Http\Controllers\API\V1\Pos;

use App\Models\Admin;
use App\Helper\Helper;
use App\Models\Seller;
use Illuminate\Support\Str;
use App\Enums\TransactionEnum;
use App\Models\PosTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\ReceivedPointNotification;
use App\Http\Resources\Pos\PosTransactionResource;
use App\Http\Requests\API\POS\CreateTransactionRequest;

class ءTransactionController extends Controller
{
    public function index()
    {
        $pos = Helper::getAuthUserFromAccessToken();

        $data = $pos->posTransaction()->latest()->get();

        return $this::sendSuccessResponse(
            PosTransactionResource::collection($data)
        );
    }

    public function show($id)
    {
        $pos = Helper::getAuthUserFromAccessToken();

        $data = PosTransaction::where('id', $id)->first();

        if (! $data) {
            return $this::sendFailedResponse(__('Data not found'));
        }

        return $this::sendSuccessResponse(
            new PosTransactionResource($data)
        );
    }

    public function check(CreateTransactionRequest $request)
    {
//        $user = Admin::where('phone', $request->phone)->first();
        $user = Seller::where('phone', $request->phone)->first();

        if (! $user) {
            return $this::sendFailedResponse(__('User not found'));
        }

        return $this::sendSuccessResponse([
            'username' => $user->name,
            'account_type' => $request->account_type,
            'phone' => $user->phone,
            'transaction_id' => Str::random(10),
        ]);
    }

    public function store(CreateTransactionRequest $request)
    {
        $user = Seller::where('phone', $request->phone)->first();

        if (! $user) {
            return $this::sendFailedResponse(__('User not found'));
        }

        $random = Str::random(10);

        DB::transaction(function () use ($request, $user, $random) {
            PosTransaction::create([
                'admin_id' => auth()->user()->id,
                'txn_id' => $random,
                'points' => $request->points,
                'is_added_points' => 0,
                'point_added_by' => auth()->user()->name,
                'transaction_type' => TransactionEnum::TRANSFER_POINT_TO_SELLER->name,
//                'account_type' => $request->account_type,
                'from_phone' => auth()->user()->phone,
                'to_phone' => $user->phone,
            ]);

            $userCurrentPoint = $user->current_points ?? 0;

            $user->update([
                'current_points' => $userCurrentPoint + $request->points,
            ]);

            auth()->user()->update([
                'pos_current_points' => auth()->user()->pos_current_points - $request->points,
            ]);

            $user->notify(new ReceivedPointNotification($request->points));
        });

        return $this::sendSuccessResponse([], __('Points Transferred Successfully'));
    }
}
