<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class QrCategory extends Model
{
    use HasTranslations;

    public array $translatable = [
        'title',
    ];

    public function QrCode()
    {
        return $this->hasMany(QrCategory::class);
    }

}
