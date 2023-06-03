<?php

namespace App\Models;

use App\Enums\SellerCategoryEnum;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SellerCategory extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    public array $translatable = [
        'title',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(SellerCategoryEnum::SELLER_CATEGORY_COLLECTION->name)->singleFile();
    }

    public function image(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(SellerCategoryEnum::SELLER_CATEGORY_COLLECTION->name);
        });
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

//    public function categories(): HasMany
//    {
//        return $this->hasMany(SellerProduct::class, 'seller_category_id');
//    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'category_id');
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(SellerSubCategory::class, 'seller_category_id');
    }

    public function governorates(): BelongsToMany
    {
        return $this->belongsToMany(Governorate::class, 'seller_category_governorates');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_category');
    }
}
