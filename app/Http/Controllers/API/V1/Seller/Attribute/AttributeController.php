<?php

namespace App\Http\Controllers\API\V1\Seller\Attribute;

use App\Models\Seller;
use App\Models\Attribute;
use App\Models\ProductOffer;
use App\Models\ProductAdsSlider;
use App\Models\ProductExhibition;
use App\Models\NotificationRequest;
use App\Http\Controllers\Controller;
use App\Models\RequestNumberSpecial;
use App\Models\UploadProductRequest;
use App\Http\Resources\AttributeResource;
use App\Models\SellerLogAdministrationService;
use App\Http\Resources\AdministrationService\SellerLogAdministrationServiceResource;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::where('status', 1)->get();

        return $this::sendSuccessResponse(AttributeResource::collection($attributes));
    }

    public function log()
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        $log = SellerLogAdministrationService::where('seller_id', $seller->id)->get();

        return $this::sendSuccessResponse(SellerLogAdministrationServiceResource::collection($log));
    }

    public function cancel($type, $id)
    {
        if ($type == 'productAdsSlider') {
            $data = ProductAdsSlider::where('id', $id)->first();
            if ($data->status == 'cancel') {
                return $this::sendFailedResponse('الخدمة ملغية من قبل');
            }
            $data->update([
                'status' => 'cancel',
            ]);
            $seller = Seller::where('id', $data->seller_id)->first();
            $seller->retrievePoint($data->points);

            return $this::sendSuccessResponse('تم الإلغاء وارجاع النقاط');
        } elseif ($type == 'productOffer') {
            $data = ProductOffer::where('id', $id)->first();
            if ($data->status == 'cancel') {
                return $this::sendFailedResponse('الخدمة ملغية من قبل');
            }
            $data->update([
                'status' => 'cancel',
            ]);
            $seller = Seller::where('id', $data->seller_id)->first();
            $seller->retrievePoint($data->points);

            return $this::sendSuccessResponse('تم الإلغاء وارجاع النقاط');
        } elseif ($type == 'sendProductInNotifications') {
            $data = NotificationRequest::where('id', $id)->first();
            if ($data->status == 'cancel') {
                return $this::sendFailedResponse('الخدمة ملغية من قبل');
            }
            $data->update([
                'status' => 'cancel',
            ]);
            $seller = Seller::where('id', $data->seller_id)->first();
            $seller->retrievePoint($data->points);

            return $this::sendSuccessResponse('تم الإلغاء وارجاع النقاط');
        } elseif ($type == 'requestNumberSpecial') {
            $data = RequestNumberSpecial::where('id', $id)->first();
            if ($data->status == 'cancel') {
                return $this::sendFailedResponse('الخدمة ملغية من قبل');
            }
            $data->update([
                'status' => 'cancel',
            ]);
            $seller = Seller::where('id', $data->seller_id)->first();
            $seller->retrievePoint($data->points);

            return $this::sendSuccessResponse('تم الإلغاء وارجاع النقاط');
        } elseif ($type == 'uploadProductRequest') {
            $data = UploadProductRequest::where('id', $id)->first();
            if ($data->status == 'cancel') {
                return $this::sendFailedResponse('الخدمة ملغية من قبل');
            }
            $data->update([
                'status' => 'cancel',
            ]);
            $seller = Seller::where('id', $data->seller_id)->first();
            $seller->retrievePoint($data->points);

            return $this::sendSuccessResponse('تم الإلغاء وارجاع النقاط');
        } elseif ($type == 'productExhibition') {
            $data = ProductExhibition::where('id', $id)->first();
            if ($data->status == 'cancel') {
                return $this::sendFailedResponse('الخدمة ملغية من قبل');
            }
            $data->update([
                'status' => 'cancel',
            ]);
            $seller = Seller::where('id', $data->seller_id)->first();
            $seller->retrievePoint($data->points);

            return $this::sendSuccessResponse('تم الإلغاء وارجاع النقاط');
        } elseif ($type == 'blueTage') {
        }
    }
}
