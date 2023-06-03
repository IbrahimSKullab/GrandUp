<?php

namespace App\Models;

use App\Traits\HasPaginationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductExhibition extends Model
{
    use HasPaginationTrait;

    public function product(): BelongsTo
    {
        return $this->belongsTo(SellerProduct::class, 'seller_product_id');
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function sellerLog(): HasMany
    {
        return $this->hasMany(SellerLogAdministrationService::class);
    }
}
