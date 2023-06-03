<?php

namespace App\Services\ShippingDelivery;

use App\Models\ShippingDelivery;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class ShippingDeliveryServices implements ServiceInterface
{
    public function get(): Collection
    {
        return ShippingDelivery::query()->latest()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return ShippingDelivery::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            ShippingDelivery::query()->create([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            ShippingDelivery::query()->findOrFail($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'account_status' => $request->account_status,
                'current_points' => $request->current_points,

            ]);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            ShippingDelivery::query()->findOrFail($id)->delete();
        });
    }
}
