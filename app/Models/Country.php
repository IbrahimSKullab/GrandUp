<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Country extends BaseModel
{
    use HasTranslations;

    public array $translatable = [
        'title',
    ];

    public function governorates()
    {
        return $this->hasMany(Governorate::class);
    }

    public function sellers()
    {
        return $this->hasMany(Seller::class);
    }

    public function pos()
    {
        return $this->hasMany(Admin::class);
    }
}
