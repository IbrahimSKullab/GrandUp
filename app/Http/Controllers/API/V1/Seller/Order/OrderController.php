<?php

namespace App\Http\Controllers\API\V1\Seller\Order;

use Exception;
use App\Models\Order;
use App\Enums\OrderEnum;
use Illuminate\Http\Request;
use App\Models\SellerProduct;
use App\Models\SellerReviews;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order\OrderResource;
use App\Services\Order\SellerOrderServices;
use App\Http\Requests\API\Order\OrderRequest;
use App\Http\Resources\Product\ProductResource;

class OrderController extends Controller
{
    public function __construct(private SellerOrderServices $sellerOrderServices)
    {
    }

    public function index()
    {
        $orders = $this->sellerOrderServices->get();

        return $this::sendSuccessResponse(OrderResource::collection($orders));
    }

    public function getBuyIndex()
    {
        $orders = $this->sellerOrderServices->GetBuyIndex();

        return $this::sendSuccessResponse(OrderResource::collection($orders));
    }

    public function show($id)
    {
        $order = $this->sellerOrderServices->findById($id);

        return $this::sendSuccessResponse(OrderResource::make($order));
    }

    public function getBuyShow($id)
    {
        $order = $this->sellerOrderServices->getBuyShow($id);

        return $this::sendSuccessResponse(OrderResource::make($order));
    }

    public function acceptOrder($id)
    {
        try {
            $this->sellerOrderServices->updateStatus($id, OrderEnum::IN_REVIEW->name);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Order Accepted'));
    }

    public function rejectOrder($id)
    {
        try {
            $this->sellerOrderServices->updateStatus($id, OrderEnum::CANCELED->name);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Order Rejected'));
    }
    
    public function reviewOrder($id)
    {
        try {
            $this->sellerOrderServices->updateStatus($id, OrderEnum::READY_TO_DELIVERY->name);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this::sendFailedResponse($exception->getMessage());
        }
        return $this::sendSuccessResponse([], __("Order in Ready On Delivery"));
    }

    public function doneOrder($id)
    {
        try {
            $this->sellerOrderServices->updateStatus($id, OrderEnum::COMPLETED->name);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Order Done'));
    }

    public function downloadOrder($id)
    {
        try {
            $url = $this->sellerOrderServices->exportPDF($id);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse(['url' => $url]);
    }

    public function store(OrderRequest $request)
    {
        try {
            $this->sellerOrderServices->store($request);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse([], __('Order Created Successfully'));
    }

    public function getProductPrices(Request $request)
    {
        $this->validate($request, [
            'products' => 'required|array|min:1',
            'products.*' => 'required|numeric|exists:seller_products,id',
        ]);

        $products = SellerProduct::query()->with('seller')->whereHas('seller', function ($query) {
            return $query->where('is_public_store', 1)->planExpiredAt();
        })
            ->where('status', 1)
            ->where('admin_approval', 1)
            ->whereIn('id', $request->products)
            ->get();

        return $this::sendSuccessResponse(ProductResource::collection($products));
    }

    public function checkOrderPoint(OrderRequest $request)
    {
        try {
            $result = $this->sellerOrderServices->getPoints($request);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse($result);
    }

    public function checkOrderVariation(Request $request)
    {
        try {
            $result = $this->sellerOrderServices->checkVariation($request);
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return $this::sendFailedResponse($exception->getMessage());
        }

        return $this::sendSuccessResponse($result);
    }

    public function sellerReview(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        $review = SellerReviews::create([
            'user_seller_id' => auth()->user()->id,
            'seller_id' => $order->seller_id,
            'rating' => $request->review,
        ]);

        return $this::sendSuccessResponse($review);
    }

}
