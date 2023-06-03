<?php

namespace App\Http\Controllers\API\V1\Country;

use App\Http\Controllers\Controller;
use App\Http\Resources\Country\CountryResource;
use App\Services\Country\CountryServices;
use App\Services\Governorate\GovernorateServices;
use App\Http\Resources\Governorate\GovernorateResource;

class CountryController extends Controller
{
    public function __construct(private CountryServices $countryServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(CountryResource::collection($this->countryServices->get()));
    }

    public function show($id)
    {
        return $this::sendSuccessResponse(CountryResource::make($this->countryServices->findById($id)));
    }
}
