<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;

class Currency extends BaseModel
{
    use HasTranslations;

    public array $translatable = [
        'title',
    ];

}
