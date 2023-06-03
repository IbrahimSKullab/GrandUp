<?php

namespace App\Services\Slider;

use App\Models\ProductAdsSlider;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SliderServices implements ServiceInterface
{
    public function get(): Collection
    {
        return ProductAdsSlider::query()
            ->where('start_at', '<', now())
            ->where('end_at', '>', now())
            ->where('status', 'accepted')
            ->latest()
            ->get();
    }

    public function getGeneral()
    {
        return ProductAdsSlider::with('seller')
            ->whereHas('seller', function ($query) {
                $query->where('is_public_store', 1)->planExpiredAt();
            })
            ->where('seller_type', 'general')
            ->where('start_at', '<', now())
            ->where('end_at', '>', now())
            ->where('status', 'accepted')
            ->latest()
            ->get();
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
            $slider = $this->findById($id);

            $slider->delete();
        });
    }

    public function findById($id, $checkStatus = false): Model
    {
        return ProductAdsSlider::query()->findOrFail($id);
    }
}
