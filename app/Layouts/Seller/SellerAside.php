<?php

namespace App\Layouts\Seller;

use App\Enums\OrderEnum;
use App\Enums\StatusEnum;

class SellerAside
{
    public static function links(): array
    {
        $productShared = '';
        if (auth()->user()->is_public_store == 1) {
            return [
                [
                    'name' => __('Dashboard'),
                    'route' => route('seller.dashboard.index'),
                    'canShow' => true,
                ],
                [
                    'name' => __('Products'),
                    'route' => '#',
                    'canShow' => true,
                    'sub_menu' => [
                        [
                            'name' => __('All Products'),
                            'route' => route('seller.product.index'),
                        ],
                        [
                            'name' => __('Newest Products'),
                            'route' => route('seller.product.index', ['status' => 'newest']),
                        ],
                        [
                            'name' => __('Most Popular Products'),
                            'route' => route('seller.product.index', ['status' => StatusEnum::MOST_POPULAR_PRODUCTS->value]),
                        ],
                        [
                            'name' => __('Active Products'),
                            'route' => route('seller.product.index', ['status' => StatusEnum::ACTIVE->value]),
                        ],
                        [
                            'name' => __('In Review Products'),
                            'route' => route('seller.product.index', ['status' => 'require_admin_approval']),
                        ],
                        [
                            'name' => __('Rejected Products'),
                            'route' => route('seller.product.index', ['status' => 'rejected']),
                        ],
                        [
                            'name' => __('Add new product'),
                            'route' => route('seller.product.create'),
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
                            'route' => route('seller.orders.index', ['status' => OrderEnum::ALL->name]),
                        ],
                        [
                            'name' => __('New Orders'),
                            'route' => route('seller.orders.index', ['status' => OrderEnum::NEW_ORDER->name]),
                        ],
                        [
                            'name' => __('In Review Orders'),
                            'route' => route('seller.orders.index', ['status' => OrderEnum::IN_REVIEW->name]),
                        ],
                        [
                            'name' => __('Completed Orders'),
                            'route' => route('seller.orders.index', ['status' => OrderEnum::COMPLETED->name]),
                        ],
                        [
                            'name' => __('Canceled Orders'),
                            'route' => route('seller.orders.index', ['status' => OrderEnum::CANCELED->name]),
                        ],
                    ],
                ],
                [
                    'name' => __('Transactions'),
                    'route' => route('seller.seller-transactions.index'),
                    'canShow' => true,
                ],
                [
                    'name' => __('Translation Center'),
                    'route' => route('seller.translation.index'),
                    'canShow' => true,
                ],
                [
                    'name' => __('Order Shared Product'),
                    'route' => route('seller.order-shared-product.index'),
                    'canShow' => true,
                ],
            ];
        } else {
            return [
                [
                    'name' => __('Dashboard'),
                    'route' => route('seller.dashboard.index'),
                    'canShow' => true,
                ],
                [
                    'name' => __('Products'),
                    'route' => '#',
                    'canShow' => true,
                    'sub_menu' => [
                        [
                            'name' => __('All Products'),
                            'route' => route('seller.product.index'),
                        ],
                        [
                            'name' => __('Newest Products'),
                            'route' => route('seller.product.index', ['status' => 'newest']),
                        ],
                        [
                            'name' => __('Most Popular Products'),
                            'route' => route('seller.product.index', ['status' => StatusEnum::MOST_POPULAR_PRODUCTS->value]),
                        ],
                        [
                            'name' => __('Active Products'),
                            'route' => route('seller.product.index', ['status' => StatusEnum::ACTIVE->value]),
                        ],
                        [
                            'name' => __('In Review Products'),
                            'route' => route('seller.product.index', ['status' => 'require_admin_approval']),
                        ],
                        [
                            'name' => __('Rejected Products'),
                            'route' => route('seller.product.index', ['status' => 'rejected']),
                        ],
                        [
                            'name' => __('Add new product'),
                            'route' => route('seller.product.create'),
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
                            'route' => route('seller.orders.index', ['status' => OrderEnum::ALL->name]),
                        ],
                        [
                            'name' => __('New Orders'),
                            'route' => route('seller.orders.index', ['status' => OrderEnum::NEW_ORDER->name]),
                        ],
                        [
                            'name' => __('In Review Orders'),
                            'route' => route('seller.orders.index', ['status' => OrderEnum::IN_REVIEW->name]),
                        ],
                        [
                            'name' => __('Completed Orders'),
                            'route' => route('seller.orders.index', ['status' => OrderEnum::COMPLETED->name]),
                        ],
                        [
                            'name' => __('Canceled Orders'),
                            'route' => route('seller.orders.index', ['status' => OrderEnum::CANCELED->name]),
                        ],
                    ],
                ],
                [
                    'name' => __('Transactions'),
                    'route' => route('seller.seller-transactions.index'),
                    'canShow' => true,
                ],
                [
                    'name' => __('Translation Center'),
                    'route' => route('seller.translation.index'),
                    'canShow' => true,
                ]];
        }
    }
}
