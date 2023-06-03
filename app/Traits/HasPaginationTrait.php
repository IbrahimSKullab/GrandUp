<?php

namespace App\Traits;

trait HasPaginationTrait
{
    public function scopeCustomPagination($query)
    {
        $query->when(request()->filled('from') && request()->from != '' && request()->filled('to') && request()->to != '', function ($query) {
            $from = (int)request()->from;
            $to = (int)request()->to;
            $total = $to - $from + 1;
            $skip = $from - 1;
            $query->skip($skip)->take($total);
        });
    }
}
