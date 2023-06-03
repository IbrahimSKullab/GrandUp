<?php

namespace App\Services\Seller;

use App\Models\Category;
use App\Models\SellerCategory;
use App\Models\SubCategory;
use DB;
use Auth;
use App\Enums\SellerEnum;
use App\Models\SellerSubCategory;
use App\Services\ServiceInterface;
use App\Enums\SellerSubCategoryEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class SellerSubCategoryServices implements ServiceInterface
{
    public function get(): Collection
    {
        return SellerSubCategory::query()->latest()->get();
    }

    public function getEnabledSubCategories($seller_id = null): Collection
    {
        return SellerSubCategory::query()
            ->where('status', 1)
            ->whereRelation('seller', 'sellers.account_status', '=', SellerEnum::ACCEPTED->name)
            ->when(! is_null($seller_id), function ($query) use ($seller_id) {
                $query->where('seller_id', $seller_id);
            })
            ->latest()
            ->get();
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $sellerSubCategory = SellerSubCategory::query()->create([
                'seller_id' => $request->seller_id,
                'seller_category_id' => $request->category_id,
                'title' => $request->title,
            ]);

            $sellerSubCategory->governorates()->sync($request->governorates ?? []);

            $sellerSubCategory->users()->sync($request->users ?? []);

            $this->handleImage($request, $sellerSubCategory);
        });
    }

    private function handleImage($request, $sellerSubCategory)
    {
        if ($request->hasFile('image')) {
            $sellerSubCategory->addMedia($request->image)->toMediaCollection(SellerSubCategoryEnum::SELLER_SUB_CATEGORY_COLLECTION->name);
        }
    }

    public function storeForSeller($request)
    {
        return DB::transaction(function () use ($request) {
            $sellerSubCategory = SellerSubCategory::query()->create([
                'seller_id' => Auth::id(),
                'seller_category_id' => $request->category_id,
                'title' => [
                    'ar' => $request->title,
                    'en' => $request->title,
                ],
            ]);

            $this->handleImage($request, $sellerSubCategory);
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $sellerSubCategory = $this->findById($id);

            $sellerSubCategory->update([
                'seller_id' => $request->seller_id,
                'seller_category_id' => $request->category_id,
                'title' => $request->title,
            ]);

            $sellerSubCategory->governorates()->sync($request->governorates ?? []);

            $sellerSubCategory->users()->sync($request->users ?? []);

            $this->handleImage($request, $sellerSubCategory);
        });
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return SellerSubCategory::query()
                ->whereRelation('seller', 'sellers.account_status', '=', SellerEnum::ACCEPTED->name)
                ->where('status', 1)
                ->findOrFail($id);
        }

        return SellerSubCategory::query()->findOrFail($id);
    }

    public function updateForSeller($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $sellerSubCategory = $this->findSellerSubCategoryById($id);

            $sellerSubCategory->update([
                'seller_category_id' => $request->category_id,
                'title' => [
                    'ar' => $request->title,
                ],
            ]);

            $this->handleImage($request, $sellerSubCategory);
        });
    }

    public function findSellerSubCategoryById($id, $checkStatus = false): Model
    {
        return Auth::user()->subCategories()->findOrFail($id);
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $sellerSubCategory = $this->findById($id);

            $sellerSubCategory->delete();
        });
    }

    public function destroyForSeller($id)
    {
        return DB::transaction(function () use ($id) {
            $sellerSubCategory = $this->findSellerSubCategoryById($id);

            $sellerSubCategory->delete();
        });
    }

    public function getSubCategoryByCategoryId($category_id): Collection
    {
        return SellerSubCategory::query()
            ->where('seller_category_id', $category_id)
            ->latest()
            ->get();
    }

    public function getSubEnabledCategoryByCategoryId($category_id, $general = false): Collection
    {
        return SellerSubCategory::query()
            ->when($general == true, function ($q) {
                return $q->whereHas('seller', function ($query) {
                    $query->where('is_public_store', 1)->planExpiredAt();
                });
            })
            ->where('seller_category_id', $category_id)
//            ->where('status', 1)
            ->latest()
            ->get();
    }

    public function toggleStatusForSeller($id)
    {
        return DB::transaction(function () use ($id) {
            $sellerCategory = $this->findSellerSubCategoryById($id);

            $sellerCategory->update([
                'status' => ! $sellerCategory->status,
            ]);
        });
    }

    public function getSubCategoryGeneralStore($id, $store_id)
    {
        $sub_category_ids = SellerSubCategory::with('seller')->whereHas('seller', function ($query) use ($id) {
            return $query->where('is_public_store', 1)->planExpiredAt();
        })->where('seller_id', $store_id)->pluck('seller_category_id')->toArray();

        $sub_category = SubCategory::where('status', 1)->whereIn('id', $sub_category_ids)->where('category_id', $id)->get();
        return $sub_category;
    }
}
