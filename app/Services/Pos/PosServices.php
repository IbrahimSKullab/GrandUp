<?php

namespace App\Services\Pos;

use DB;
use Hash;
use App\Models\Admin;
use App\Enums\AdminEnum;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class PosServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Admin::query()
            ->where('is_staff', 0)
            ->where('is_agent', 0)
            ->where('is_pos', 1)
            ->get();
    }

    public function getEnabledPos(): Collection
    {
        return Admin::query()
            ->where('is_staff', 0)
            ->where('is_agent', 0)
            ->where('is_pos', 1)
            ->where('status', 1)
            ->customPagination()
            ->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return Admin::query()
                ->where('is_staff', 0)
                ->where('is_agent', 0)
                ->where('is_pos', 1)
                ->where('status', 1)
                ->findOrFail($id);
        }

        return Admin::query()
            ->where('is_staff', 0)
            ->where('is_agent', 0)
            ->where('is_pos', 1)
            ->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $admin = Admin::query()->create([
                'is_pos' => 1,
                'is_agent' => 0,
                'is_staff' => 0,
                'name' => $request->name,
                'phone' => $request->phone,
                'governorate_id' => $request->governorate_id,
                'address' => $request->address,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            $this->handleImage($request, $admin);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $admin = $this->findById($id);

            $admin->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'governorate_id' => $request->governorate_id,
                'address' => $request->address,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $request->filled('password') ? Hash::make($request->password) : $admin->password,
            ]);

            $this->handleImage($request, $admin);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $admin = $this->findById($id);

            $admin->delete();
        });
    }

    private function handleImage($request, $admin)
    {
        if ($request->hasFile('image')) {
            $admin->addMedia($request->image)->toMediaCollection(AdminEnum::POS_IMAGE->name);
        }
    }

    public function findByPhone($phone)
    {
        return Admin::query()
            ->where('is_pos', 1)
            ->where('is_agent', 0)
            ->where('is_staff', 0)
            ->where('phone', $phone)
            ->firstOrFail();
    }
}
