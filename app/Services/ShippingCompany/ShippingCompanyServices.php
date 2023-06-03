<?php

namespace App\Services\ShippingCompany;

use App\Models\ShippingCompany;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ShippingCompanyServices implements ServiceInterface
{
    public function get(): Collection
    {
        return ShippingCompany::query()->latest()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return ShippingCompany::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            ShippingCompany::query()->create([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            ShippingCompany::query()->findOrFail($id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'account_status' => $request->account_status,
                'current_points' => $request->current_points

            ]);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            ShippingCompany::query()->findOrFail($id)->delete();
        });
    }
}
