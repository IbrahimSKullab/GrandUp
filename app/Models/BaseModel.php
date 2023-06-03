<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function ScopeEnabled($query)
    {
        return $query->where('status', 1);
    }

    public function ScopeDisabled($query)
    {
        return $query->where('status', 0);
    }
}
