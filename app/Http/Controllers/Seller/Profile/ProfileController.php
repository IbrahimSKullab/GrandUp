<?php

namespace App\Http\Controllers\Seller\Profile;

use Auth;
use Hash;
use App\Enums\UserEnum;
use App\Enums\GuardEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\Profile\ProfileRequest;
use App\Http\Requests\Seller\Profile\UpdatePasswordRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return view('seller.pages.profile.index');
    }

    public function update(ProfileRequest $request)
    {
        $admin = Auth::guard(GuardEnum::SELLER->value)->user();

        $admin->update([
            'name' => $request->name,
            'governorate_id' => $request->governorate_id,
            'location' => $request->location,
            'description' => $request->description,
            'time_to' => $request->time_to,
            'time_from' => $request->time_from,
        ]);

        if ($request->hasFile('avatar')) {
            $admin->addMedia($request->avatar)->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
        }

        return back()->with('success', __('Profile Updated Successfully'));
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        Auth::guard(GuardEnum::SELLER->value)->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', __('Password Updated Successfully'));
    }
}
