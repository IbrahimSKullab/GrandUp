<?php

namespace App\Http\Resources\Transaction;

use App\Helper\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'txn_id' => $this->txn_id,
            'points' => $this->points,
            'transaction_type' => strip_tags(Helper::TransactionTypeText($this->transaction_type)),
            'card_number' => $this->card_number,
            'is_added_points' => $this->is_added_points,
            'point_added_by' => $this->point_added_by,
            'credit_by_admin' => $this->credit_by_admin,
            'from_phone' => $this->from_phone,
            'to_phone' => $this->to_phone,
        ];
    }
}
