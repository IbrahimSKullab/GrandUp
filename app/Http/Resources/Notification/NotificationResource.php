<?php

namespace App\Http\Resources\Notification;

use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'image' => self::makeImage($this->data),
            'title' => $this->title($this->data),
            'content' => $this->content($this->data),
            'is_read' => $this->read_at != null,
            'read_at' => $this->read_at?->format('Y-m-d H:i:s'),
            'read_at_for_humans' => $this->read_at?->diffForHumans(),
            'created_at' => Helper::formatDate($this->created_at),
            'created_at_for_humans' => $this->created_at->diffForHumans(),
        ];
    }

    private function title($data): string
    {
        return $data['title'][app()->getLocale()];
    }

    private function content($data): string
    {
        return $data['content'][app()->getLocale()];
    }

    private static function makeImage($data)
    {
        return $data['image'];
    }
}
