<?php

namespace App\Services\Role;

use DB;
use App\Models\Role;
use Illuminate\Support\Str;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class RoleServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Role::query()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return Role::query()->whereNotIn('id', [1, 2, 3])->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $role = Role::query()->create([
                'title' => $request->title,
                'name' => Str::random(15),
            ]);
            $role->syncPermissions($request->permissions);

            return $role;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $role = $this->findById($id);
            $role->update([
                'title' => $request->title,
            ]);
            $role->syncPermissions($request->permissions);

            return $role;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $role = $this->findById($id);
            $role->delete();
        });
    }
}
