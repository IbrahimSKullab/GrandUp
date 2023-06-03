<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Governorate extends BaseModel
{
    use HasTranslations;

    public array $translatable = [
        'title',
    ];

    public function Country()
    {
        return $this->belongsTo(Country::class);
    }

    public function sellers()
    {
        return $this->hasMany(Seller::class);
    }
}
