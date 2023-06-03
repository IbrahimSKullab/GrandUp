<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftOrderItem extends Model
{
    public function gift(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Gift::class);
    }
}
