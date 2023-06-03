<?php

namespace App\Services\Attribute;

use App\Models\Attribute;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AttributeServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Attribute::query()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return Attribute::query()->where('status', 1)->findOrFail($id);
        }

        return Attribute::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            return Attribute::query()->create([
                'title' => $request->title,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $attribute = $this->findById($id);

            $attribute->update([
                'title' => $request->title,
            ]);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $attribute = $this->findById($id);

            $attribute->delete();
        });
    }
}
