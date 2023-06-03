<?php

namespace App\Enums;

enum ResponseEnum
{
    case SUCCESS_RESPONSE;

    case FAILED_RESPONSE;

    case VALIDATION_ERROR_RESPONSE;

    case MODEL_DATA_NOT_FOUND;

    case TOO_MANY_ATTEMPTS;

    case UNAUTHENTICATED;
}
