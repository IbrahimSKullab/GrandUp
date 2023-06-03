<?php

namespace App\Http\Controllers\API\V1\IntroImages;

use App\Http\Controllers\Controller;
use App\Services\IntroImages\IntroImagesServices;
use App\Http\Resources\IntroImages\IntroImagesResource;

class IntroImagesController extends Controller
{
    public function __construct(private IntroImagesServices $introImagesServices)
    {
    }

    public function __invoke()
    {
        return $this::sendSuccessResponse(IntroImagesResource::collection($this->introImagesServices->get()));
    }
}
