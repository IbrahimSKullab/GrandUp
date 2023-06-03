<?php

namespace App\Http\Controllers\API\V1\Seller\Stuff;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Seller\SellerStuffServices;
use App\Http\Requests\Seller\SellerStuffRequest;
use App\Http\Resources\Seller\PermissionResource;
use App\Http\Resources\Seller\SellerStuffResource;
use App\Http\Requests\Seller\UpdateSellerStuffRequest;

class SellerStuffController extends Controller
{
    public function __construct(private SellerStuffServices $sellerStuffServices)
    {
    }

    public function index(): JsonResponse
    {
        $seller = Auth::user();

//        if ($seller->can('stuff')) {
        $requests = $this->sellerStuffServices->getAll();

        return $this::sendSuccessResponse(SellerStuffResource::collection($requests));
//        } else {
//            return $this::sendFailedResponse('unauthorized_action', 403, '');
//        }
    }

    public function store(SellerStuffRequest $request): JsonResponse
    {
        $request = $this->sellerStuffServices->store($request);

        return $this::sendSuccessResponse(SellerStuffResource::make($request));
    }

    public function update(UpdateSellerStuffRequest $request, $id): JsonResponse
    {
        $request = $this->sellerStuffServices->update($request, $id);

        return $this::sendSuccessResponse(SellerStuffResource::make($request));
    }

    public function delete($id): JsonResponse
    {
        $request = $this->sellerStuffServices->delete($id);

        return $this::sendSuccessResponse($request);
    }

    public function changeStatus(Request $request, $id): JsonResponse
    {
        $request = $this->sellerStuffServices->changeStatus($request, $id);

        return $this::sendSuccessResponse(SellerStuffResource::make($request));
    }

    public function getPermissions(): JsonResponse
    {
        $request = $this->sellerStuffServices->getAllPermissions();

        return $this::sendSuccessResponse(PermissionResource::collection($request));
    }
}
