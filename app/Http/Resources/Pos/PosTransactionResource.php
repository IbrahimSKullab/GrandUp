<?php

namespace App\Http\Resources\Pos;

use App\Http\Resources\Seller\SellerResource;
use App\Models\Admin;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PosTransactionResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from' => PosResource::make(Admin::where('phone', $this->from_phone)->first()),
            'to' => SellerResource::make(Seller::where('phone', $this->to_phone)->first()),
            'points' => $this->points,
            'transaction_id' => $this->txn_id,
            'transaction_type' => $this->transaction_type,
            'account_type' => $this->account_type,
            'date' => $this->created_at,
        ];
    }
}
