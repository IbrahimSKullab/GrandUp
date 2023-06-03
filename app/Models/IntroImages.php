<?php

namespace App\Models;

use App\Enums\IntroImagesEnum;
use Spatie\MediaLibrary\HasMedia;
use App\Traits\HasTranslationTrait;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\IntroImages
 *
 * @property int $id
 * @property array $title
 * @property array $description
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|IntroImages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IntroImages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IntroImages query()
 * @method static \Illuminate\Database\Eloquent\Builder|IntroImages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IntroImages whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IntroImages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IntroImages whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IntroImages whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IntroImages whereUpdatedAt($value)
 */
class IntroImages extends BaseModel implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasTranslationTrait;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(IntroImagesEnum::IMAGE->value)->singleFile();
    }

    public function image(): Attribute
    {
        return Attribute::get(function () {
            return $this->getFirstMediaUrl(IntroImagesEnum::IMAGE->value);
        });
    }
}
