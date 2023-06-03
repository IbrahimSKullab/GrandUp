<?php

namespace App\Services\RequestNumberSpecial;

use App\Models\RequestNumberSpecial;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RequestNumberSpecialServices implements ServiceInterface
{
    public function get(): Collection
    {
        return RequestNumberSpecial::query()
            ->where('status', 'accepted')
            ->latest()
            ->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return RequestNumberSpecial::query()->findOrFail($id);
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
            $request_number_special = $this->findById($id);

            $request_number_special->delete();
        });
    }
}
