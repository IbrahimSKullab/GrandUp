<?php

namespace App\Datatables;

use App\Helper\Helper;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Support\DataTableActions;
use Yajra\DataTables\Facades\DataTables;

class SubscriptionDatatables implements DatatableInterface
{
    public static function columns(): array
    {
        return [
            'title' => ['title->ar'],
            'subscription_type' => ['subscription_type'],
            'subscription_period' => ['subscription_period'],
            'points' => ['points'],
            'status',
            'created_at',
            'updated_at',
        ];
    }

    public function datatables(Request $request)
    {
        return Datatables::of($this->query($request))
            ->addColumn('title', function (Subscription $subscription) {
                return $subscription->title;
            })
            ->addColumn('subscription_type', function (Subscription $subscription) {
                return match ($subscription->subscription_type) {
                    'months' => __('Month'),
                    'days' => __('Day'),
                    'years' => __('Year')
                };
            })
            ->addColumn('subscription_period', function (Subscription $subscription) {
                return $subscription->subscription_period;
            })
            ->addColumn('points', function (Subscription $subscription) {
                return $subscription->points ?? ("<span class='badge badge-info'>" . __('Free Subscription') . '</span>');
            })
            ->addColumn('created_at', function (Subscription $subscription) {
                return Helper::formatDate($subscription->created_at);
            })
            ->addColumn('updated_at', function (Subscription $subscription) {
                return Helper::formatDate($subscription->updated_at);
            })
            ->addColumn('status', function (Subscription $subscription) {
                return (new DataTableActions())
                    ->model($subscription)
                    ->modelId($subscription->id)
                    ->checkStatus($subscription->status)
                    ->switcher();
            })
            ->addColumn('action', function (Subscription $subscription) {
                if ($subscription->is_free_subscription) {
                    return (new DataTableActions())
                        ->edit(route('admin.subscription.edit', $subscription->id))
                        ->make();
                } else {
                    return (new DataTableActions())
                        ->edit(route('admin.subscription.edit', $subscription->id))
                        ->delete(route('admin.subscription.destroy', $subscription->id))
                        ->make();
                }
            })
            ->rawColumns(['action', 'status', 'points'])
            ->make();
    }

    public function query(Request $request)
    {
        return Subscription::query()
            ->latest()
            ->select('*');
    }
}
