<?php

namespace App\Http\Controllers\API\V1\Offer;

use App\Http\Controllers\Controller;
use App\Services\Offer\OfferServices;
use App\Http\Resources\Offer\OfferResource;

class OfferController extends Controller
{
    public function __construct(private readonly OfferServices $offerServices)
    {
    }

    public function __invoke()
    {
        $offers = $this->offerServices->get();

        return $this::sendSuccessResponse([
            'count' => $this->offerServices->count(),
            'data' => OfferResource::collection($offers),
        ]);
    }
}
