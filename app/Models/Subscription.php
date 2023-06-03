<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subscription extends Model
{
    use HasTranslations;

    public array $translatable = ['title', 'description'];
}
