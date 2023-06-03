<?php

namespace App\Enums;

enum OrderEnum: string
{
    case ALL = 'ALL';
    // USER
    case NEW_ORDER = 'NEW_ORDER'; // طلب جديد
    // SELLER
    case IN_REVIEW = 'IN_REVIEW'; // في المراجعة
    case READY_TO_DELIVERY = 'READY_TO_DELIVERY'; // جاهز لتوصيل

    // SHIPPING AND DELIVERY
    case IN_DELIVERY = 'IN_DELIVERY'; // مع مندوب التوصيل
    case IN_THE_WAY = 'IN_THE_WAY'; // في الطريق للزبون

    case COMPLETED = 'COMPLETED'; // تم التوصيل النهاية

    case CANCELED = 'CANCELED'; // ملغي
}
