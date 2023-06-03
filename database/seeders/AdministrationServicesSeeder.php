<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdministrationService;

class AdministrationServicesSeeder extends Seeder
{
    public function run()
    {
        AdministrationService::query()->create([
            'title' => [
                'ar' => 'خدمة الاشتراك الشهري',
                'en' => 'Monthly subscription service',
            ],
            'description' => [
                'ar' => 'مقابل بعض العملات يمكنك اضافة منتجاتك فى العروض الخاصة لزيادة المبيعات لديك',
                'en' => 'For some coins, you can add your products in special offers to increase your sales',
            ],
            'point' => 50,
            'status' => 1,
        ]);

        AdministrationService::query()->create([
            'title' => [
                'ar' => 'شراء رقم متجر مميز',
                'en' => 'Buy a unique store number',
            ],
            'description' => [
                'ar' => 'مقابل بعض العملات يمكنك اضافة منتجاتك فى العروض الخاصة لزيادة المبيعات لديك',
                'en' => 'For some coins, you can add your products in special offers to increase your sales',
            ],
            'point' => 50,
            'status' => 1,
        ]);

        AdministrationService::query()->create([
            'title' => [
                'ar' => 'ارسال منتجاتك فى الاشعارات!',
                'en' => 'Send your products in notifications!',
            ],
            'description' => [
                'ar' => 'مقابل بعض العملات يمكنك اضافة منتجاتك فى العروض الخاصة لزيادة المبيعات لديك',
                'en' => 'For some coins, you can add your products in special offers to increase your sales',
            ],
            'point' => 50,
            'status' => 1,
        ]);

        AdministrationService::query()->create([
            'title' => [
                'ar' => 'ضيف منتجاتك فى اعلان اسلايدر',
                'en' => 'Add your products in a slider ad',
            ],
            'description' => [
                'ar' => 'مقابل بعض العملات يمكنك اضافة منتجاتك فى العروض الخاصة لزيادة المبيعات لديك',
                'en' => 'For some coins, you can add your products in special offers to increase your sales',
            ],
            'point' => 50,
            'status' => 1,
        ]);

        AdministrationService::query()->create([
            'title' => [
                'ar' => 'اضافة نقاط على المنتجات',
                'en' => 'Add points to products',
            ],
            'description' => [
                'ar' => 'مقابل بعض العملات يمكنك اضافة منتجاتك فى العروض الخاصة لزيادة المبيعات لديك',
                'en' => 'For some coins, you can add your products in special offers to increase your sales',
            ],
            'point' => 50,
            'status' => 1,
        ]);

        AdministrationService::query()->create([
            'title' => [
                'ar' => 'العلامة الزرقاء',
                'en' => 'blue tag',
            ],
            'description' => [
                'ar' => 'مقابل بعض العملات يمكنك اضافة منتجاتك فى العروض الخاصة لزيادة المبيعات لديك',
                'en' => 'For some coins, you can add your products in special offers to increase your sales',
            ],
            'point' => 50,
            'status' => 1,
        ]);

        AdministrationService::query()->create([
            'title' => [
                'ar' => 'رفع المنتجات بشكل جماعي',
                'en' => 'Collecting products',
            ],
            'description' => [
                'ar' => 'مقابل بعض العملات يمكنك اضافة منتجاتك فى العروض الخاصة لزيادة المبيعات لديك',
                'en' => 'For some coins, you can add your products in special offers to increase your sales',
            ],
            'point' => 50,
            'status' => 1,
        ]);

        AdministrationService::query()->create([
            'title' => [
                'ar' => 'اضافة منتج لقسم العروض الخاصة',
                'en' => 'Add a product to the special offers section',
            ],
            'description' => [
                'ar' => 'مقابل بعض العملات يمكنك اضافة منتجاتك فى العروض الخاصة لزيادة المبيعات لديك',
                'en' => 'For some coins, you can add your products in special offers to increase your sales',
            ],
            'point' => 50,
            'status' => 1,
        ]);
        AdministrationService::query()->create([
            'title' => [
                'ar' => 'اضافة منتج لقسم المعارض الخاصة',
                'en' => 'Add a product to the Exhibition section',
            ],
            'description' => [
                'ar' => 'مقابل بعض العملات يمكنك اضافة منتجاتك فى العروض الخاصة لزيادة المبيعات لديك',
                'en' => 'For some coins, you can add your products in special offers to increase your sales',
            ],
            'point' => 50,
            'status' => 1,
        ]);
    }
}
