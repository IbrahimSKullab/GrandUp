<?php

namespace App\Models;

use App\Enums\GiftEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasPaginationTrait;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;

class SellerViolation extends BaseModel
{
    use HasTranslations;

    use HasPaginationTrait;

    public array $translatable = ['notes'];

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

}
