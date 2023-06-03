<?php

namespace App\Services\Gift;

use DB;
use App\Models\Gift;
use App\Enums\GiftEnum;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class GiftServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Gift::query()->latest()->where('status', 1)->customPagination()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return Gift::query()->where('status', 1)->findOrFail($id);
        }

        return Gift::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $gift = Gift::query()->create([
                'title' => $request->title,
                'description' => $request->description,
                'points' => $request->points,
            ]);

            $this->handleImageUpload($request, $gift);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $gift = $this->findById($id);

            $gift->update([
                'title' => $request->title,
                'description' => $request->description,
                'points' => $request->points,
            ]);

            $this->handleImageUpload($request, $gift);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $gift = $this->findById($id);
            $gift->delete();
        });
    }

    private function handleImageUpload($request, $gift)
    {
        if ($request->hasFile('image')) {
            $gift->addMedia($request->image)->toMediaCollection(GiftEnum::GIFT_CARD_IMAGE->name);
        }
    }
}
