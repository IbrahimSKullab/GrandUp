<?php

namespace App\Services\Governorate;

use DB;
use App\Models\Governorate;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class GovernorateServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Governorate::query()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return Governorate::query()->where('status', 1)->findOrFail($id);
        }

        return Governorate::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return Governorate::query()->create([
                'title' => $request->title,
                'country_id' => $request->country_id,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $governorate = $this->findById($id);

            $governorate->update([
                'title' => $request->title,
                'country_id' => $request->country_id,
            ]);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $governorate = $this->findById($id);

            $governorate->delete();
        });
    }
}
