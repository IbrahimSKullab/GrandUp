<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use App\Enums\SellerSubCategoryEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SellerReviews extends Model
{

    public function seller(): BelongsTo // seller order
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userSeller(): BelongsTo // seller review
    {
        return $this->belongsTo(Seller::class, 'user_seller_id');
    }
}
