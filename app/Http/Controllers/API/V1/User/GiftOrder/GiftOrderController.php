<?php

namespace App\Http\Controllers\API\V1\User\GiftOrder;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\GiftOrderRequest;
use App\Services\GiftOrder\GiftOrderServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class GiftOrderController extends Controller
{
    public function __construct(private GiftOrderServices $giftOrderServices)
    {
    }

    public function __invoke(GiftOrderRequest $request)
    {
        try {
            $request = $request->merge([
                'user_id' => Auth::id(),
            ]);
            $this->giftOrderServices->store($request);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse(__('Your gift order send successfully'));
    }
}
