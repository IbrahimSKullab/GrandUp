<?php

namespace App\Http\Controllers\API\V1\Seller\AdministrationServices;

use App\Models\Seller;
use Log;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Services\Administration\AdministrationServices;

class NotificationController extends Controller
{
    public function __construct(private AdministrationServices $administrationServices)
    {
    }

    public function __invoke(Request $request)
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        $this->validate($request, [
            'notification_time_id' => 'required|exists:notification_times,id',
            'product_id' => [
                'required',
                Rule::exists('seller_products', 'id')->where('seller_id', $seller->id),
            ],
        ]);

        try {
            $this->administrationServices->sendNotification($request->notification_time_id, $seller->id, $request);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Notification Submitted Successfully'));
    }
}
