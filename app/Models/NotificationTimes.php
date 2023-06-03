<?php

namespace App\Models;

use App\Traits\HasPaginationTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class NotificationTimes extends Model
{
    use HasTranslations;

    use HasPaginationTrait;

    public array $translatable = ['title', 'description'];

    protected $casts = [
        'date' => 'datetime',
    ];
}
