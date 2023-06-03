<?php

namespace App\Models;

use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends BaseModel
{
    use HasTranslations;

    public array $translatable = ['title'];

    public function questions(): HasMany
    {
        return $this->hasMany(PollQuestion::class);
    }
}
