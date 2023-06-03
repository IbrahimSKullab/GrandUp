<?php

namespace App\Services\User;

use App\Models\User;
use App\Enums\UserEnum;
use App\Models\GeneralSetting;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class UserServices implements ServiceInterface
{
    public function get(): Collection
    {
        return User::query()->get();
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $user = User::query()->create([
                'name' => $request->name,
                'user_name' => $request->user_name,
                'phone' => $request->phone,
                'status' => 1,
                'address' => $request->address,
                'hashed_login_otp' => null,
                'country_id' => $request->country_id,
                'governorate_id' => $request->governorate_id,
                'enable_features_search' => GeneralSetting::first()?->default_value_of_features_search ?? 0,
                'enable_viewing_points' => GeneralSetting::first()?->default_value_of_viewing_points ?? 0,
            ]);

            if ($request->hasFile('profile_image')) {
                $user->addMedia($request->profile_image)->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
            }

            if (! empty($request->invitation_code)) {
                $invited_status = GeneralSetting::query()->first()->invited_status;
                $invited_point = GeneralSetting::query()->first()->invited_point;
                if ($invited_status == 1) {
                    $invited_by = User::where('invitation_code', $request->invitation_code)->first();
                    $user->invite_by = $invited_by->id;
                    $user->current_points = $user->current_points + $invited_point;
                    $user->save();
                }
            }

            return $user;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $user = $this->findById($id);

            $user->update([
                'name' => $request->name,
                'address' => $request->address,
                'governorate_id' => $request->governorate_id,
                'enable_features_search' => $request->boolean('enable_features_search'),
                'enable_viewing_points' => $request->boolean('enable_viewing_points'),
            ]);

            if ($request->hasFile('profile_image')) {
                $user->addMedia($request->profile_image)->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
            }

            return $user;
        });
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return User::query()->where('status', 1)->findOrFail($id);
        }

        return User::query()->findOrFail($id);
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $user = $this->findById($id);

            $user->delete();
        });
    }

    public function findByPhone($phone): User
    {
        return User::query()->where('phone', $phone)->firstOrFail();
    }
}
