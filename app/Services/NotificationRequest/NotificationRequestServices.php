<?php

namespace App\Services\NotificationRequest;

use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use App\Models\NotificationRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class NotificationRequestServices implements ServiceInterface
{
    public function get(): Collection
    {
    }

    public function findById($id, $checkStatus = false): Model
    {
        return NotificationRequest::query()->findOrFail($id);
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $notificationRequest = $this->findById($id);

            $notificationRequest->delete();
        });
    }
}
