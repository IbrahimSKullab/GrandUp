<?php

namespace App\Http\Resources\Subscription;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $is_free_subscription
 * @property mixed $subscription_period
 * @property mixed $subscription_type
 * @property mixed $points
 * @property mixed $title
 * @property mixed $id
 * @property mixed $description
 */
class SubscriptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'subscription_type' => $this->subscription_type,
            'subscription_period' => $this->subscription_period,
            'points' => $this->points,
            'is_free_subscription' => $this->is_free_subscription == true,
        ];
    }
}
