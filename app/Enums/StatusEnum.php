<?php

namespace App\Enums;

enum StatusEnum:string
{
    case ACTIVE = 'active';

    case INACTIVE = 'in-active';

    case MOST_POPULAR_PRODUCTS = 'most_popular_products';
}
