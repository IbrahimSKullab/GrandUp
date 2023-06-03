<?php

namespace App\Services\NotificationTime;

use DB;
use Carbon\Carbon;
use App\Models\NotificationTimes;
use App\Services\ServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class NotificationTimeServices implements ServiceInterface
{
    public function get(): Collection
    {
        return NotificationTimes::query()
            ->where('is_reserved', 0)
            ->customPagination()
            ->where('date', '>', now())
            ->get();
    }

    public function count()
    {
        return NotificationTimes::query()
            ->where('is_reserved', 0)
            ->where('date', '>', now())
            ->count();
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return NotificationTimes::query()
                ->where('is_reserved', 0)
                ->where('date', '>', now())
                ->findOrFail($id);
        }

        return NotificationTimes::query()->findOrFail($id);
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $dates = explode(',', $request->notificationDates);
            foreach ($dates as $date) {
                NotificationTimes::query()->create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'number_of_notifications' => $request->number_of_notifications,
                    'date' => Carbon::parse($date . ' ' . $request->time)->format('Y-m-d H:i:s'),
                    'points' => $request->points,
                ]);
            }
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $notification = $this->findById($id);

            $notification->update([
                'title' => $request->title,
                'description' => $request->description,
                'number_of_notifications' => $request->number_of_notifications,
                'date' => $request->date,
                'points' => $request->points,
            ]);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $notification = $this->findById($id);

            $notification->delete();
        });
    }
}
