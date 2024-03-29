<?php

namespace App\Http\Controllers\API\V1\Seller\AdministrationServices;

use App\Models\Seller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Services\Administration\AdministrationServices;

class BlueTagController extends Controller
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

        try {
            $this->administrationServices->requestBlueTag($seller->id, $request);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Add Submitted Successfully'));
    }
}
