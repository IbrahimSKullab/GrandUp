<?php

namespace App\Services\DeliveryRates;

use App\Models\DeliveryRates;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class DeliveryRatesServices implements ServiceInterface
{
    public function get(): Collection
    {
        return DeliveryRates::query()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return DeliveryRates::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return DeliveryRates::query()->create([
                'price' => $request->price,
                'type' => $request->type,
                'country_id' => $request->country_id,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $deliveryRate = $this->findById($id);

            $deliveryRate->update([
                'price' => $request->price,
                'type' => $request->type,
                'country_id' => $request->country_id,
            ]);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $deliveryRate = $this->findById($id);

            $deliveryRate->delete();
        });
    }
}
