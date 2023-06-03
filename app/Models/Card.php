<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Card extends Model
{
    use HasTranslations;

    public array $translatable = ['title'];

    public function scopeShipping($q)
    {
        $q->where('type', 4);
    }
}
