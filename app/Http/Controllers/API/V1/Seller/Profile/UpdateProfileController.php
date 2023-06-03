<?php

namespace App\Http\Controllers\API\V1\Seller\Profile;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Seller\SellerServices;
use App\Http\Resources\Seller\SellerResource;
use App\Http\Requests\API\Seller\ProfileRequest;

class UpdateProfileController extends Controller
{
    public function __construct(private SellerServices $sellerServices)
    {
    }

    public function updateBasicInformation(ProfileRequest $request)
    {
        $seller = $this->sellerServices->update($request, Auth::id());

        return $this::sendSuccessResponse(SellerResource::make($seller), __('Profile Updated Successfully'));
    }

    public function updateLang(Request $request)
    {
        $this->validate($request, [
            'default_lang' => 'required|in:ar,en',
        ]);
        Auth::user()->update([
            'default_lang' => $request->default_lang,
        ]);

        return $this::sendSuccessResponse([], __('Lang Updated Successfully'));
    }

    public function updateNotification(Request $request)
    {
        Auth::user()->update([
            'enable_notification' => ! Auth::user()->enable_notification,
        ]);

        return $this::sendSuccessResponse([], __('Notification Updated Successfully'));
    }
}
