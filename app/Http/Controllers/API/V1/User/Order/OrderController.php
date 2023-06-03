<?php

namespace App\Http\Controllers\API\V1\User\Order;

use App\Models\Order;
use App\Models\Seller;
use App\Models\SellerReviews;
use Exception;
use Illuminate\Http\Request;
use App\Models\SellerProduct;
use App\Http\Controllers\Controller;
use App\Services\Order\UserOrderServices;
use App\Http\Resources\Order\OrderResource;
use App\Http\Requests\API\Order\OrderRequest;
use App\Http\Resources\Product\ProductResource;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct(private UserOrderServices $userOrderServices)
    {
    }

    public function index()
    {
        $orders = $this->userOrderServices->get();

        return $this::sendSuccessResponse(OrderResource::collection($orders));
    }

    public function show($id)
    {
        $order = $this->userOrderServices->findById($id);

        return $this::sendSuccessResponse(OrderResource::make($order));
    }

    public function getProductPrices(Request $request)
    {
        $this->validate($request, [
            'products' => 'required|array|min:1',
            'products.*' => 'required|numeric|exists:seller_products,id',
        ]);

        $products = SellerProduct::query()
            ->where('status', 1)
            ->where('admin_approval', 1)
            ->whereIn('id', $request->products)
            ->get();

        return $this::sendSuccessResponse(ProductResource::collection($products));
    }

    public function store(OrderRequest $request)
    {
        try {
            $this->userOrderServices->store($request);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Order Created Successfully'));
    }

    public function checkOrderPoint(OrderRequest $request)
    {
        try {
            $result = $this->userOrderServices->getPoints($request);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse($result);
    }

    public function checkOrderVariation(Request $request)
    {
        try {
            $result = $this->userOrderServices->checkVariation($request);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse($result);
    }

    public function userReview(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        $review = SellerReviews::create([
            'user_id' => auth()->user()->id,
            'seller_id' => $order->seller_id,
            'rating' => $request->review,
        ]);

        return $this::sendSuccessResponse($review);
    }
}
