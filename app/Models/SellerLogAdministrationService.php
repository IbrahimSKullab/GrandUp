<?php

namespace App\Models;

use App\Services\ProductExhibition\ProductExhibitionServices;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class SellerLogAdministrationService extends Model
{
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'seller_id', 'id');
    }

    public function productAdsSlider(): BelongsTo
    {
        return $this->belongsTo(ProductAdsSlider::class, 'product_ads_slider_id', 'id');
    }

    public function blueTag(): BelongsTo
    {
        return $this->belongsTo(BlueTag::class, 'blue_tag_id', 'id');
    }

    public function productOffer(): BelongsTo
    {
        return $this->belongsTo(ProductOffer::class, 'product_offer_id', 'id');
    }

    public function sendProductInNotifications(): BelongsTo
    {
        return $this->belongsTo(NotificationRequest::class, 'n_request_id', 'id');
    }

    public function requestNumberSpecial(): BelongsTo
    {
        return $this->belongsTo(RequestNumberSpecial::class, 'r_n_s_id', 'id');
    }

    public function uploadProductRequest(): BelongsTo
    {
        return $this->belongsTo(UploadProductRequest::class, 'u_p_r_id', 'id');
    }

    public function productExhibition(): BelongsTo
    {
        return $this->belongsTo(ProductExhibition::class, 'product_exhibition_id', 'id');
    }

}

