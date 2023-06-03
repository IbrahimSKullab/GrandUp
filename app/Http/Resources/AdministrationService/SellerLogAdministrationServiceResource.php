<?php

namespace App\Http\Resources\AdministrationService;

use Illuminate\Http\Request;
use App\Models\AdministrationService;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $description
 * @property mixed $status
 */
class SellerLogAdministrationServiceResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            $this->mergeWhen(! empty($this->productAdsSlider), [
                'type' => 'productAdsSlider',
                'transaction' => new LogServiceResource($this->productAdsSlider),
                'data' => new AdministrationServiceResource(AdministrationService::where('id', 4)->first()),
            ]),
            $this->mergeWhen(! empty($this->productOffer), [
                'type' => 'productOffer',
                'transactions' => new LogServiceResource($this->productOffer),
                'data' => new AdministrationServiceResource(AdministrationService::where('id', 8)->first()),
            ]),
            $this->mergeWhen(! empty($this->sendProductInNotifications), [
                'type' => 'sendProductInNotifications',
                'transactions' => new LogServiceResource($this->sendProductInNotifications),
                'data' => new AdministrationServiceResource(AdministrationService::where('id', 3)->first()),
            ]),
            $this->mergeWhen(! empty($this->requestNumberSpecial), [
                'type' => 'requestNumberSpecial',
                'transactions' => new LogServiceResource($this->requestNumberSpecial),
                'data' => new AdministrationServiceResource(AdministrationService::where('id', 2)->first()),
            ]),
            $this->mergeWhen(! empty($this->uploadProductRequest), [
                'type' => 'uploadProductRequest',
                'transactions' => new LogServiceResource($this->uploadProductRequest),
                'data' => new AdministrationServiceResource(AdministrationService::where('id', 7)->first()),

            ]),
            $this->mergeWhen(! empty($this->blueTage), [
                'type' => 'blueTage',
                'transactions' => new LogServiceResource($this->upload_product_request),
                'data' => new AdministrationServiceResource(AdministrationService::where('id', 6)->first()),
            ]),
            $this->mergeWhen(! empty($this->productExhibition), [
                'transactions' => new LogServiceResource($this->productExhibition),
                'data' => new AdministrationServiceResource(AdministrationService::where('id', 5)->first()),
            ]),
        ];
    }
}
