<?php

namespace App\Enums;

enum ShippingEnum: string
{
    case REQUIRE_APPROVAL = 'REQUIRE_APPROVAL';

    case ACCEPTED = 'ACCEPTED';

    case SUSPENDED = 'SUSPENDED';

    case QR_CODE = 'QR_CODE';

    // Currencies => Iraqi Dinar , DOLLAR
    case ID = 'ID';

    case DOLLAR = 'DOLLAR';

    case SELLER_QR_CODE = 'SELLER_QR_CODE';

    //deliveries
    case ACTIVE = 'ACTIVE';

    case NOT_ACTIVE = 'NOT_ACTIVE';

    case SHIPPING_COMPANY_PROFILE_COLLECTION = 'SHIPPING_COMPANY_PROFILE_COLLECTION';


}
