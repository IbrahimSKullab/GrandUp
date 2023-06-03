<?php

namespace App\Services\Offer;

use DB;
use App\Models\ProductOffer;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class OfferServices implements ServiceInterface
{
    public function get(): Collection
    {
        return ProductOffer::query()
            ->where('start_at', '<', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->where('end_at', '>', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->customPagination()
            ->latest()
            ->get();
    }

    public function count(): int
    {
        return ProductOffer::query()
            ->where('start_at', '<', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->where('end_at', '>', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->count();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return ProductOffer::query()->findOrFail($id);
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $offer = $this->findById($id);

            $offer->delete();
        });
    }
}
