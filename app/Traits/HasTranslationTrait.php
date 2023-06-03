<?php

namespace App\Traits;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasTranslationTrait
{
    use HasTranslations;

    public array $translatable = [
        'title',
        'description',
        'name',
    ];

    public function title(): Attribute
    {
        return Attribute::get(fn () => $this->translate('title', 'ar'));
    }

    public function name(): Attribute
    {
        return Attribute::get(fn () => $this->translate('name', 'ar'));
    }

    public function description(): Attribute
    {
        return Attribute::get(fn () => $this->translate('title', 'ar'));
    }
}
