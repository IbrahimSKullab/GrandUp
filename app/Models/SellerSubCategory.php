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

class SellerSubCategory extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    public array $translatable = [
        'title',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(SellerSubCategoryEnum::SELLER_SUB_CATEGORY_COLLECTION->name)->singleFile();
    }

    public function image(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(SellerSubCategoryEnum::SELLER_SUB_CATEGORY_COLLECTION->name);
        });
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(SellerCategory::class, 'seller_category_id');
    }

    public function governorates(): BelongsToMany
    {
        return $this->belongsToMany(Governorate::class, 'seller_sub_category_governorate');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_sub_category');
    }
}
