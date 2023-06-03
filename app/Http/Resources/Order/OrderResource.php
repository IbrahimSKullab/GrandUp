<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use App\Http\Resources\User\UserPublicResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Seller\SellerPublicResource;

class OrderResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'seller' => SellerPublicResource::make($this->seller),
            'user' => UserPublicResource::make($this->user),
            'user_seller' => SellerPublicResource::make($this->userSeller),
            'code' => $this->code,
            'total_cost' => $this->total_cost,
            'total_qty' => $this->total_qty,
            'total_cost_currency' => $this->total_cost_currency,
            'points' => $this->points,
            'status' => $this->status,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'order_items' => OrderItemsResource::collection($this->orderItems),
            'histories' => OrderHistoryResource::collection($this->histories),
        ];
    }
}
