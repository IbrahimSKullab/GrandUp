<?php

namespace App\Http\Controllers\API\V1\GeneralSetting;

use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Http\Resources\GeneralSetting\GeneralSettingResource;

class GeneralSettingController extends Controller
{
    public function __invoke()
    {
        $gs = GeneralSetting::query()->first();

        return $this::sendSuccessResponse(GeneralSettingResource::make($gs));
    }
}
