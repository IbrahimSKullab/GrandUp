<?php

namespace App\Models;

use App\Enums\UploadProductEnum;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UploadProductRequest extends Model implements HasMedia
{
    use InteractsWithMedia;

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(UploadProductEnum::IMAGES->name)->singleFile();
        $this->addMediaCollection(UploadProductEnum::EXCELSHEET->name)->singleFile();
    }

    public function excelsheet(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(UploadProductEnum::EXCELSHEET->name);
        });
    }

    public function zipFile(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(UploadProductEnum::IMAGES->name);
        });
    }
}
