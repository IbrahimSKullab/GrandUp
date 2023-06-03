<?php

namespace App\Http\Controllers\API\V1\User\Profile;

use Auth;
use App\Enums\UserEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;

class UpdateProfileController extends Controller
{
    public function updateBasicInformation(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'governorate_id' => 'required|exists:governorates,id',
            'country_id' => 'required|exists:countries,id',
            'address' => 'required|string',
        ]);

        Auth::user()->update([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'country_id' => $request->country_id,
            'governorate_id' => $request->governorate_id,
            'address' => $request->address,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude
        ]);

        if ($request->hasFile('profile_image')) {
            Auth::user()->addMedia($request->profile_image)->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
        }

        return $this::sendSuccessResponse(UserResource::make(Auth::user()), __('Profile Updated Successfully'));
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
