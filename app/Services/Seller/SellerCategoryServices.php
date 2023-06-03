<?php

namespace App\Services\Seller;

use DB;
use Auth;
use App\Models\Seller;
use App\Models\Category;
use App\Enums\SellerEnum;
use App\Models\SellerCategory;
use App\Enums\SellerCategoryEnum;
use App\Services\ServiceInterface;
use App\Models\SellerClassification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class SellerCategoryServices implements ServiceInterface
{
    public function get(): Collection
    {
        return SellerCategory::query()->latest()->get();
    }

    public function getEnabledCategories($seller_id = null, $enabled = true): Collection
    {
        return SellerCategory::query()
            ->whereRelation('seller', 'sellers.account_status', '=', SellerEnum::ACCEPTED->name)
            ->when(! is_null($seller_id), function ($query) use ($seller_id) {
                $query->where('seller_id', $seller_id);
            })
            ->when($enabled, function ($query) {
                $query->where('status', 1);
            })
            ->latest()
            ->get();
    }

    public function getSellerCategories(): Collection
    {
        return Auth::user()->categories()->latest()->get();
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $sellerCategory = SellerCategory::query()->create([
                'seller_id' => $request->seller_id,
                'title' => $request->title,
            ]);

            if ($request->hasFile('image')) {
                $sellerCategory->addMedia($request->image)->toMediaCollection(SellerCategoryEnum::SELLER_CATEGORY_COLLECTION->name);
            }

            $sellerCategory->governorates()->sync($request->governorates ?? []);

            $sellerCategory->users()->sync($request->users ?? []);
        });
    }

    public function storeForSeller($request)
    {
        return DB::transaction(function () use ($request) {
            $sellerCategory = SellerCategory::query()->create([
                'seller_id' => Auth::id(),
                'title' => [
                    'ar' => $request->title,
                    'en' => $request->title,
                ],
            ]);

            if ($request->hasFile('image')) {
                $sellerCategory->addMedia($request->image)->toMediaCollection(SellerCategoryEnum::SELLER_CATEGORY_COLLECTION->name);
            }
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $sellerCategory = $this->findById($id);

            $sellerCategory->update([
                'title' => $request->title,
            ]);

            if ($request->hasFile('image')) {
                $sellerCategory->addMedia($request->image)->toMediaCollection(SellerCategoryEnum::SELLER_CATEGORY_COLLECTION->name);
            }

            $sellerCategory->governorates()->sync($request->governorates ?? []);

            $sellerCategory->users()->sync($request->users ?? []);

            return $sellerCategory;
        });
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return SellerCategory::query()
                ->whereRelation('seller', 'sellers.account_status', SellerEnum::ACCEPTED->name)
                ->where('status', 1)
                ->findOrFail($id);
        }

        return SellerCategory::query()->findOrFail($id);
    }

    public function updateForSeller($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $sellerCategory = $this->findSellerCategoryById($id);

            $sellerCategory->update([
                'title' => [
                    'ar' => $request->title,
                ],
            ]);

            if ($request->hasFile('image')) {
                $sellerCategory->addMedia($request->image)->toMediaCollection(SellerCategoryEnum::SELLER_CATEGORY_COLLECTION->name);
            }

            return $sellerCategory;
        });
    }

    public function findSellerCategoryById($id): Model
    {
        return Auth::user()->categories()->findOrFail($id);
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $sellerCategory = $this->findById($id);
            $sellerCategory->delete();
        });
    }

    public function destroyForSeller($id)
    {
        return DB::transaction(function () use ($id) {
            $sellerCategory = $this->findSellerCategoryById($id);
            $sellerCategory->delete();
        });
    }

    public function toggleStatusForSeller($id)
    {
        return DB::transaction(function () use ($id) {
            $sellerCategory = $this->findSellerCategoryById($id);
            $sellerCategory->update([
                'status' => ! $sellerCategory->status,
            ]);
        });
    }

    public function getSellerClassification($id, $general)
    {
        $seller_id = SellerClassification::with('seller')->when($general == true, function ($q) {
            return $q->whereHas('seller', function ($query) {
                $query->where('is_public_store', 1)->planExpiredAt();
            });
        })->when($general == false, function ($q) {
            return $q->whereHas('seller', function ($query) {
                $query->sellerLocal();
            });
        })->where('category_id', $id)->limit(20)->pluck('seller_id')->toArray();

        $seller = Seller::whereIn('id', $seller_id)->planExpiredAt()->get();

        return $seller;
    }

    public function getCategoryGeneralStore($id)
    {
        $category_ids = SellerCategory::with('seller')->whereHas('seller', function ($query) use ($id) {
            return $query->where('is_public_store', 1)->planExpiredAt();
        })->where('seller_id', $id)->pluck('category_id')->toArray();

        $category = Category::where('status', 1)->whereIn('id', $category_ids)->get();

        return $category;
    }
}
