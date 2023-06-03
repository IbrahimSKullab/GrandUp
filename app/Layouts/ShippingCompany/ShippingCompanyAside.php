<?php

namespace App\Layouts\ShippingCompany;

use App\Enums\OrderEnum;
use App\Enums\StatusEnum;

class ShippingCompanyAside
{
    public static function links(): array
    {
        $productShared = '';
        if (auth()->user()) {
            return [
                [
                    'name' => __('Dashboard'),
                    'route' => route('shipping.company.dashboard.index'),
                    'canShow' => true,
                ],
                [
                    'name' => __('Products'),
                    'route' => '#',
                    'canShow' => true,
                    'sub_menu' => [
                        [
                            'name' => __('All Products'),
                            'route' => route('shipping.company.product.index'),
                        ],
                        [
                            'name' => __('Newest Products'),
                            'route' => route('shipping.company.product.index', ['status' => 'newest']),
                        ],
                        [
                            'name' => __('Most Popular Products'),
                            'route' => route('shipping.company.product.index', ['status' => StatusEnum::MOST_POPULAR_PRODUCTS->value]),
                        ],
                        [
                            'name' => __('Active Products'),
                            'route' => route('shipping.company.product.index', ['status' => StatusEnum::ACTIVE->value]),
                        ],
                        [
                            'name' => __('In Review Products'),
                            'route' => route('shipping.company.product.index', ['status' => 'require_admin_approval']),
                        ],
                        [
                            'name' => __('Rejected Products'),
                            'route' => route('shipping.company.product.index', ['status' => 'rejected']),
                        ],
                        [
                            'name' => __('Add new product'),
                            'route' => route('shipping.company.product.create'),
                        ],
                    ],
                ],
                [
                    'name' => __('Orders'),
                    'route' => '#',
                    'canShow' => true,
                    'sub_menu' => [
                        [
                            'name' => __('All Orders'),
                            'route' => route('shipping.company.orders.index', ['status' => OrderEnum::ALL->name]),
                        ],
                        [
                            'name' => __('New Orders'),
                            'route' => route('shipping.company.orders.index', ['status' => OrderEnum::NEW_ORDER->name]),
                        ],
                        [
                            'name' => __('In Review Orders'),
                            'route' => route('shipping.company.orders.index', ['status' => OrderEnum::IN_REVIEW->name]),
                        ],
                        [
                            'name' => __('Completed Orders'),
                            'route' => route('shipping.company.orders.index', ['status' => OrderEnum::COMPLETED->name]),
                        ],
                        [
                            'name' => __('Canceled Orders'),
                            'route' => route('shipping.company.orders.index', ['status' => OrderEnum::CANCELED->name]),
                        ],
                    ],
                ],
                [
                    'name' => __('Transactions'),
                    'route' => route('shipping.company.seller-transactions.index'),
                    'canShow' => true,
                ],
                [
                    'name' => __('Translation Center'),
                    'route' => route('shipping.company.translation.index'),
                    'canShow' => true,
                ],
                [
                    'name' => __('Order Shared Product'),
                    'route' => route('shipping.company.order-shared-product.index'),
                    'canShow' => true,
                ],
            ];
        }
    }
}
