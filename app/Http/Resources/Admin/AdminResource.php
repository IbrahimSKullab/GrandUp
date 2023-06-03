<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'username' => $this->username,
            'device_token' => $this->device_token,
            'status' => $this->status,
            'profile_image' => $this->profile_image,
            'all_notification_count' => $this->notifications()->count(),
            'un_read_notification_count' => $this->unReadNotifications()->count(),
        ];
    }
}
