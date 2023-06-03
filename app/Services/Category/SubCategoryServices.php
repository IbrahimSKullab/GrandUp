<?php

namespace App\Services\Category;

use App\Models\SubCategory;
use App\Enums\SubCategoryEnum;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class SubCategoryServices implements ServiceInterface
{
    public function get(): Collection
    {
        return SubCategory::query()->latest()->get();
    }

    public function getEnabledSubCategories(): Collection
    {
        return subCategory::query()
            ->where('status', 1)->latest()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return subCategory::query()
                ->where('status', 1)
                ->findOrFail($id);
        }

        return subCategory::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $subCategory = subCategory::query()->create([
                'category_id' => $request->category_id,
                'title' => $request->title,
            ]);

            $subCategory->governorates()->sync($request->governorates ?? []);
            $subCategory->sellers()->sync($request->sellers ?? []);

            $this->handleImage($request, $subCategory);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $subCategory = $this->findById($id);

            $subCategory->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
            ]);

            $subCategory->governorates()->sync($request->governorates ?? []);
            $subCategory->sellers()->sync($request->sellers ?? []);

            $this->handleImage($request, $subCategory);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $subCategory = $this->findById($id);

            $subCategory->delete();
        });
    }

    public function getSubCategoryByCategoryId($category_id): Collection
    {
        return subCategory::query()
            ->where('category_id', $category_id)
            ->where('status', 1)->latest()->get();
    }

    public function getSubEnabledCategoryByCategoryId($category_id): Collection
    {
        return subCategory::query()
            ->where('seller_category_id', $category_id)
            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function toggleStatusForSeller($id)
    {
        return DB::transaction(function () use ($id) {
            $sellerCategory = $this->findById($id);

            $sellerCategory->update([
                'status' => ! $sellerCategory->status,
            ]);
        });
    }

    private function handleImage($request, $subCategory)
    {
        if ($request->hasFile('image')) {
            $subCategory->addMedia($request->image)->toMediaCollection(subCategoryEnum::SUB_CATEGORY_COLLECTION->name);
        }
    }
}
