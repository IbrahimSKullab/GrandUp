<?php

namespace App\Services\Category;

use App\Models\Category;
use App\Enums\CategoryEnum;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class CategoryServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Category::query()->latest()->get();
    }

    public function getEnabledCategories($request, $enabled = true): Collection
    {
        return Category::query()
            ->when($enabled, function ($query) {
                $query->where('status', 1);
            })
            ->latest()
            ->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return Category::query()
                ->where('status', 1)
                ->findOrFail($id);
        }

        return Category::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $category = Category::query()->create([
                'title' => $request->title,
            ]);

            if ($request->hasFile('image')) {
                $category->addMedia($request->image)->toMediaCollection(CategoryEnum::CATEGORY_COLLECTION->name);
            }

            $category->governorates()->sync($request->governorates ?? []);
            $category->sellers()->sync($request->sellers ?? []);
        });
    }

    public function storeForSeller($request)
    {
        return DB::transaction(function () use ($request) {
            $category = Category::query()->create([
                'seller_id' => Auth::id(),
                'title' => [
                    'ar' => $request->title,
                    'en' => $request->title,
                ],
            ]);

            if ($request->hasFile('image')) {
                $category->addMedia($request->image)->toMediaCollection(CategoryEnum::CATEGORY_COLLECTION->name);
            }
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $category = $this->findById($id);

            $category->update([
                'title' => $request->title,
            ]);

            if ($request->hasFile('image')) {
                $category->addMedia($request->image)->toMediaCollection(CategoryEnum::CATEGORY_COLLECTION->name);
            }

            $category->governorates()->sync($request->governorates ?? []);
            $category->sellers()->sync($request->sellers ?? []);

            return $category;
        });
    }

    public function updateForSeller($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $category = $this->findById($id);

            $category->update([
                'title' => [
                    'ar' => $request->title,
                ],
            ]);

            if ($request->hasFile('image')) {
                $category->addMedia($request->image)->toMediaCollection(CategoryEnum::CATEGORY_COLLECTION->name);
            }

            return $category;
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $category = $this->findById($id);
            $category->delete();
        });
    }

    public function toggleStatus($id)
    {
        return DB::transaction(function () use ($id) {
            $category = $this->findById($id);
            $category->update([
                'status' => ! $category->status,
            ]);
        });
    }
}
