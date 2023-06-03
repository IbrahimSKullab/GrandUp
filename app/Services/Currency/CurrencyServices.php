<?php

namespace App\Services\Currency;

use App\Models\Currency;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CurrencyServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Currency::query()->get();
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return Currency::query()->create([
                'title' => $request->title,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $country = $this->findById($id);

            $country->update([
                'title' => $request->title,
            ]);
        });
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return Currency::query()->where('status', 1)->findOrFail($id);
        }

        return Currency::query()->findOrFail($id);
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $country = $this->findById($id);

            $country->delete();
        });
    }
}
