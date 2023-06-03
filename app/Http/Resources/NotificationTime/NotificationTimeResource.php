<?php

namespace App\Http\Resources\NotificationTime;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationTimeResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'number_of_notifications' => $this->number_of_notifications,
            'date' => $this->date->format('Y-m-d H:i A'),
            'points' => $this->points,
            'is_reserved' => (bool)$this->is_reserved,
        ];
    }
}
