<?php

namespace App\Services\SellerSharedProduct;

use Exception;
use App\Models\Seller;
use App\Models\SellerProduct;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use App\Models\SellerSharedProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\Seller\SharedProductApprovedNotification;
use App\Notifications\Seller\SharedProductRejectedNotification;

class SellerSharedProductServices implements ServiceInterface
{
    public function get(): Collection
    {
        return SellerSharedProduct::query()->latest()->customPagination()->get();
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function findById($id, $checkStatus = false): Model
    {
        return SellerSharedProduct::query()->findOrFail($id);
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $product_share = $this->findById($id);
            $product = SellerProduct::where('product_shared_id', $product_share->id)->first();
            $product->delete();
            $product_share->delete();
        });
    }


    public function changeStatus($id, $status)
    {
        $product_shared = SellerSharedProduct::query()->find($id);

        $seller = Seller::query()->find($product_shared->user_seller_id);

        if ($product_shared->status == 'accepted') {
            throw new Exception(__('Request already approved before'));
        }

        if ($product_shared->status == 'rejected') {
            throw new Exception(__('Request already rejected before'));
        }

        $product_shared->update([
            'status' => $status,
            'rejection_reason' => $status == 'rejected' ? request()->rejection_reason : null,
        ]);

        if ($status == 'accepted') {
            $product = SellerProduct::find($product_shared->seller_product_id);
            $newProduct = $product->replicate();
            $newProduct->seller_id = $seller->id;
            $newProduct->is_editable = 0;
            $newProduct->save();
            $product_shared->sellerUser->notify(new SharedProductApprovedNotification($product_shared));
        }

        if ($status == 'rejected') {
            $product_shared->sellerUser->notify(new SharedProductRejectedNotification($product_shared));
        }
    }
}
