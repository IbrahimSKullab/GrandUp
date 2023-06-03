<?php

namespace App\Services\Agent;

use DB;
use App\Models\Admin;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class AgentServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Admin::query()
            ->where('is_pos', 0)
            ->where('is_staff', 0)
            ->where('is_agent', 1)
            ->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return Admin::query()
            ->where('is_pos', 0)
            ->where('is_staff', 0)
            ->where('is_agent', 1)
            ->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $admin = Admin::query()->create([
                'is_pos' => 0,
                'is_agent' => 1,
                'is_staff' => 0,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);

            $admin->pos()->sync($request->pos_id);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $admin = $this->findById($id);

            $admin->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $request->filled('password') ? Hash::make($request->password) : $admin->password,
            ]);

            $admin->pos()->sync($request->pos_id);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $admin = $this->findById($id);

            $admin->delete();
        });
    }

    public function findByPhone($phone)
    {
        return Admin::query()
            ->where('is_pos', 0)
            ->where('is_staff', 0)
            ->where('is_agent', 1)
            ->where('phone', $phone)
            ->firstOrFail();
    }
}
