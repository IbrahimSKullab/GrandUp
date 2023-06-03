<?php

namespace App\Models;

use App\Enums\CategoryEnum;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    public array $translatable = [
        'title',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(CategoryEnum::CATEGORY_COLLECTION->name)->singleFile();
    }

    public function image(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(CategoryEnum::CATEGORY_COLLECTION->name);
        });
    }

    public function products(): HasMany
    {
        return $this->hasMany(SellerProduct::class, 'category_id');
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }

    public function governorates(): BelongsToMany
    {
        return $this->belongsToMany(Governorate::class, 'category_governorates');
    }

    public function sellers(): BelongsToMany
    {
        return $this->belongsToMany(Seller::class, 'seller_categories');
    }

    public function sellerClassification(): HasMany
    {
        return $this->hasMany(SellerClassification::class, 'category_id', 'id');
    }
}
