<?php

namespace App\Models;

class DeliveryRates extends BaseModel
{

    public function Country()
    {
        return $this->belongsTo(Country::class);
    }
}
