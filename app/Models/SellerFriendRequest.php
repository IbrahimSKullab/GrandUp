<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellerFriendRequest extends Model
{

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }

    public function storeSeller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'store_seller_id', 'id');
    }
}
