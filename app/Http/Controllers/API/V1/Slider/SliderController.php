<?php

namespace App\Http\Controllers\API\V1\Slider;

use App\Http\Controllers\Controller;
use App\Services\Slider\SliderServices;
use App\Http\Resources\Slider\SliderResource;

class SliderController extends Controller
{
    public function __construct(private SliderServices $sliderServices)
    {
    }

    public function __invoke()
    {
        $sliders = $this->sliderServices->get();

        return $this::sendSuccessResponse(SliderResource::collection($sliders));
    }
}
