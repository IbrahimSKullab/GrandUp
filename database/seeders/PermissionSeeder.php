<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Enums\GuardEnum;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $stuff_permission = Permission::query()->create([
            'title' => [
                'ar' => 'المشرفين',
                'en' => 'Stuff',
            ],
            'name' => 'stuff',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $add_product_permission = Permission::query()->create([
            'title' => [
                'ar' => 'إضافة منتجات',
                'en' => 'Products Add',
            ],
            'name' => 'products_add',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $friendships_accept_permission = Permission::query()->create([
            'title' => [
                'ar' => 'قبول طلبات صداقات',
                'en' => 'Friendships Accept',
            ],
            'name' => 'friendships_accept',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $accept_order_permission = Permission::query()->create([
            'title' => [
                'ar' => 'قبول طلبيات الشراء',
                'en' => 'Acceptance of purchase orders',
            ],
            'name' => 'accept_order',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $purchase_administration_permission = Permission::query()->create([
            'title' => [
                'ar' => ' شراء خدمات إدارية',
                'en' => 'Purchasing administrative services',
            ],
            'name' => 'purchasing_administrative_services',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $subscribe_monthly_subscription_permission = Permission::query()->create([
            'title' => [
                'ar' => 'اشتراك بالاشتراك الشهري',
                'en' => 'Subscribe to a monthly subscription',
            ],
            'name' => 'subscribe_monthly_subscription',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $buy_products_international_store_permission = Permission::query()->create([
            'title' => [
                'ar' => 'شراء المنتجات من المتجر الدولي',
                'en' => 'Buy products from the international store',
            ],
            'name' => 'buy_products_international_store',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $request_share_products_international_store_permission = Permission::query()->create([
            'title' => [
                'ar' => 'طلب مشاركة منتجات من المتجر الدولي',
                'en' => 'Request share products from the international store',
            ],
            'name' => 'request_share_products_international_store',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $section_messages_permission = Permission::query()->create([
            'title' => [
                'ar' => 'قسم الرسائل',
                'en' => 'Section Messages',
            ],
            'name' => 'section_messages',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $account_points_management_permission = Permission::query()->create([
            'title' => [
                'ar' => 'ادارة نقاط الحساب',
                'en' => 'Account points management',
            ],
            'name' => 'account_points_management',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $store_settings_permission = Permission::query()->create([
            'title' => [
                'ar' => 'اعدادات المتجر',
                'en' => 'Store settings',
            ],
            'name' => 'store_settings',
            'guard_name' => GuardEnum::SELLER->value,
        ]);

        $adminPermissions = [
            [
                'title' => [
                    'ar' => 'المستخدمين',
                    'en' => 'Users',
                ],
                'name' => 'users',
            ],
            [
                'title' => [
                    'ar' => 'أصحاب المتاجر',
                    'en' => 'Sellers',
                ],
                'name' => 'sellers',
            ],
            [
                'title' => [
                    'ar' => 'الكتالوج',
                    'en' => 'Catalog',
                ],
                'name' => 'catalog',
            ],
            [
                'title' => [
                    'ar' => 'طلبات المنتجات',
                    'en' => 'Orders',
                ],
                'name' => 'orders',
            ],
            [
                'title' => [
                    'ar' => 'طلبات الهدايا',
                    'en' => 'Gift Orders',
                ],
                'name' => 'gift_orders',
            ],
            [
                'title' => [
                    'ar' => 'طلبات خدمات الإدارة',
                    'en' => 'Admin Services Orders',
                ],
                'name' => 'admin_services_orders',
            ],
            [
                'title' => [
                    'ar' => 'نقاط البيع و الوكلاء',
                    'en' => 'Pos and agents',
                ],
                'name' => 'pos_and_agents',
            ],
            [
                'title' => [
                    'ar' => 'معاملات النقاط',
                    'en' => 'Point Transactions',
                ],
                'name' => 'point_transaction',
            ],
            [
                'title' => [
                    'ar' => 'الصلاحيات و المشرفين',
                    'en' => 'Permissions & Staff',
                ],
                'name' => 'staff',
            ],
            [
                'title' => [
                    'ar' => 'الإعدادات العامة',
                    'en' => 'General Setting',
                ],
                'name' => 'general_setting',
            ],
        ];
        foreach ($adminPermissions as $permission) {
            $createdPermission = Permission::query()->create([
                'title' => [
                    'en' => $permission['title']['en'],
                    'ar' => $permission['title']['ar'],
                ],
                'name' => $permission['name'],
                'guard_name' => GuardEnum::ADMIN,
            ]);
            $this->command->info('Permission Created With title ' . $createdPermission->getTranslation('title', 'en'));

        }


    }
}
