<?php

namespace App\Services\Notification;

use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Auth::user()->notifications()->get();
    }

    public function findById($id, $checkStatus = false): Model
    {
        return Auth::user()->notifications()->findOrFail($id);
    }

    public function markAsRead($id)
    {
        return DB::transaction(function () use ($id) {

            $notification = $this->findById($id);
            $notification->markAsRead();

        });
    }

    public function markAllAsRead()
    {
        return DB::transaction(function () {
            $this->get()->map(function ($notification) {
                $notification->markAsRead();
            });
        });
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

            $notification = $this->findById($id);
            $notification->delete();

        });
    }

    public function destroyAll()
    {
        return DB::transaction(function () {
            $this->get()->map(function ($notification) {
                $notification->delete();
            });
        });
    }
}
