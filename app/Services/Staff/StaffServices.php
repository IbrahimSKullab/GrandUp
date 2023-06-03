<?php

namespace App\Services\Staff;

use DB;
use Hash;
use App\Models\Admin;
use App\Enums\UserEnum;
use App\Support\ResizeImage;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class StaffServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Admin::query()->where('is_staff', true)->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return Admin::query()->where('id', '!=', 1)->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $staff = Admin::query()->create([
                'name' => $request->name,
                'email' => $request->email,
                'is_staff' => 1,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

            $staff->assignRole($request->role);

            if ($request->hasFile('user_profile_image')) {
                $image = (new ResizeImage())
                    ->width(150)
                    ->height(150)
                    ->upload($request->user_profile_image);
                $staff->addMedia($image)->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
            }

            return $staff;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $staff = Admin::query()->where('id', '!=', 1)->findOrFail($id);

            tap($staff)->update([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->filled('password') ? Hash::make($request->password) : $staff->password,
            ]);

            $staff->syncRoles([$request->role]);

            if ($request->hasFile('user_profile_image')) {
                $image = (new ResizeImage())
                    ->width(150)
                    ->height(150)
                    ->upload($request->user_profile_image);
                $staff->addMedia($image)->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
            }

            return $staff;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $staff = $this->findById($id);
            $staff->delete();
        });
    }
}
