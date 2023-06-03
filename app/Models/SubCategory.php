<?php

namespace App\Models;

use App\Enums\SubCategoryEnum;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubCategory extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia;

    public array $translatable = [
        'title',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(SubCategoryEnum::SUB_CATEGORY_COLLECTION->name)->singleFile();
    }

    public function image(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(SubCategoryEnum::SUB_CATEGORY_COLLECTION->name);
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function governorates(): BelongsToMany
    {
        return $this->belongsToMany(Governorate::class, 'sub_category_governorate');
    }

    public function sellers(): BelongsToMany
    {
        return $this->belongsToMany(Seller::class, 'seller_sub_categories');
    }
}
