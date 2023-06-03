<?php

namespace App\Services\RequestBlueTag;

use App\Models\BlueTag;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RequestBlueTagServices implements ServiceInterface
{
    public function get(): Collection
    {
        return BlueTag::query()
            ->where('status', 'accepted')
            ->latest()
            ->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return BlueTag::query()->findOrFail($id);
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
            $blueTag = $this->findById($id);

            $blueTag->delete();
        });
    }
}
