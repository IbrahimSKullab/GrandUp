<?php

namespace App\Services\SellerViolation;

use App\Models\SellerViolation;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class SellerViolationServices implements ServiceInterface
{
    public function get(): Collection
    {
        return SellerViolation::query()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return SellerViolation::query()->findOrFail($id);
        }

        return SellerViolation::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return SellerViolation::query()->create([
                'notes' => $request->notes,
                'seller_id' => $request->seller_id,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $sellerViolation = $this->findById($id);

            $sellerViolation->update([
                'notes' => $request->notes,
            ]);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $sellerViolation = $this->findById($id);

            $sellerViolation->delete();
        });
    }
}
