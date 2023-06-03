<?php

namespace App\Services\ProductExhibition;

use App\Models\ProductExhibition;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ProductExhibitionServices implements ServiceInterface
{
    public function get(): Collection
    {
        return ProductExhibition::query()
            ->where('start_at', '<', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->where('end_at', '>', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->customPagination()
            ->latest()
            ->get();
    }

    public function count(): int
    {
        return ProductExhibition::query()
            ->where('start_at', '<', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->where('end_at', '>', now()->endOfDay()->format('Y-m-d H:i:s'))
            ->count();
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

    public function findById($id, $checkStatus = false): Model
    {
        return ProductExhibition::query()->findOrFail($id);
    }
}
