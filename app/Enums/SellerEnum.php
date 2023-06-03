<?php

namespace App\Enums;

enum SellerEnum
{
    case REQUIRE_APPROVAL;

    case ACCEPTED;

    case SUSPENDED;

    case QR_CODE;

    // Currencies => Iraqi Dinar , DOLLAR
    case ID;

    case DOLLAR;

    case SELLER_QR_CODE;
}
