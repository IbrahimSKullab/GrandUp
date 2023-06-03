<?php

namespace App\Http\Controllers\API\V1\Pos;

use App\Enums\AdminEnum;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Pos\PosResource;
use App\Http\Requests\API\POS\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function index()
    {
        return $this::sendSuccessResponse(PosResource::make(Auth::user()));
    }

    public function edit(Admin $admin)
    {
        return $this::sendSuccessResponse([
            'pos_info' => PosResource::make($admin),
        ]);
    }

    public function update(UpdateProfileRequest $request, Admin $admin)
    {
        $admin->update([
            'name' => $request->name,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'governorate_id' => $request->governorate_id,
        ]);

        if ($request->hasFile('profile_image')) {
            $admin->addMedia($request->profile_image)->toMediaCollection(AdminEnum::POS_IMAGE->name);
        }

        return $this::sendSuccessResponse(
            PosResource::make($admin),
            __('You Account Information Updated Successfully')
        );
    }
}
