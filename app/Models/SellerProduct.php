<?php

namespace App\Models;

use App\Enums\ProductEnum;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasPaginationTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SellerProduct extends Model implements HasMedia
{
    use HasTranslations, InteractsWithMedia, Searchable;

    use HasPaginationTrait;
    use Favoriteable;


    public array $translatable = [
        'title',
        'description',
    ];

    /**

     * Get the index name for the model.

     *

     * @return string

     */

    public function searchableAs()

    {

        return 'products_index';

    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ProductEnum::PRODUCT_IMAGE_COLLECTION->name)->singleFile();
        $this->addMediaCollection(ProductEnum::PRODUCT_QR_CODE->name)->singleFile();
    }

    public function image(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(ProductEnum::PRODUCT_IMAGE_COLLECTION->name);
        });
    }

    public function qrCode(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(ProductEnum::PRODUCT_QR_CODE->name);
        });
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function sellerCategory(): BelongsTo
    {
        return $this->belongsTo(SellerCategory::class, 'category_id');
    }

    public function sellerSubCategory(): BelongsTo
    {
        return $this->belongsTo(SellerSubCategory::class, 'sub_category_id');
    }


    public function activeOffers(): BelongsTo
    {
        return $this
            ->belongsTo(ProductOffer::class, 'seller_product_id')
            ->where('product_offers.start_at', '<', now())
            ->where('product_offers.end_at', '>', now());
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeNewest($query)
    {
        return $query->where('new_product', 1);
    }

    public function scopePoint($query)
    {
        return $query->whereNotNull('points');
    }
    public function offerSellers()
    {
        return $this->belongsToMany(Seller::class, 'product_offers');
    }
}
