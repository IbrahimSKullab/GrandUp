<?php

namespace App\Enums;

enum GuardEnum: string
{
    case ADMIN = 'admin';

    case SELLER = 'seller';

    case AGENT = 'agent';

    case POS = 'pos';

    case SHIPPING_COMPANY = 'shipping_company';

}
