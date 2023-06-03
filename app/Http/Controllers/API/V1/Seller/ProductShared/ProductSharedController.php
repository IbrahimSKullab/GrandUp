<?php

namespace App\Http\Controllers\API\V1\Seller\ProductShared;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductSharedResponse;
use App\Services\SellerSharedProduct\SellerSharedProductServices;

class ProductSharedController extends Controller
{
    public function __construct(private SellerSharedProductServices $productServices)
    {
    }

    public function index()
    {
        return $this::sendSuccessResponse(ProductSharedResponse::collection($this->productServices->get()));
    }

    public function delete($id)
    {
        $this->productServices->destroy($id);

        return $this::sendSuccessResponse('', 'delete successfully');
    }

    public function accept($id)
    {
        $this->productServices->changeStatus($id, 'accepted');

        return $this::sendSuccessResponse('', 'accepted');
    }

    public function reject(Request $request, $id)
    {
        $this->validate($request, [
            'rejection_reason' => 'required|string|max:255',
        ]);

        $this->productServices->changeStatus($id, 'rejected');

        return $this::sendSuccessResponse('', 'rejected');
    }
}
