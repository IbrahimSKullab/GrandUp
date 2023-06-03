<?php

namespace App\Models;

use App\Traits\HasPaginationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellerSharedProduct extends Model
{

    use HasPaginationTrait;

    protected $table = 'seller_shared_products';

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function sellerUser(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'user_seller_id');
    }

    public function sellerProduct()
    {
        return $this->belongsTo(SellerProduct::class, 'seller_product_id');
    }
}
