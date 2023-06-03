<?php

namespace Database\Seeders;

use App\Models\IntroImages;
use App\Enums\IntroImagesEnum;
use Illuminate\Database\Seeder;

class IntroImagesSeeder extends Seeder
{
    public function run()
    {
        $items = [
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'user',
            ],
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'user',
            ],
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'user',
            ],

            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'seller',
            ],
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'seller',
            ],
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'seller',
            ],

            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'general_store',
            ],
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'general_store',
            ],
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'general_store',
            ],

            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'pos',
            ],
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'pos',
            ],
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'pos',
            ],

            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'delivery',
            ],
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'delivery',
            ],
            [
                'title' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                    'en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
                'description' => [
                    'ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه',
                    'en' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
                ],
                'image' => public_path('test_images/agency.png'),
                'for_seller' => 'delivery',
            ],
        ];

        foreach ($items as $item) {
            $introImage = IntroImages::query()->create([
                'title' => $item['title'],
                'description' => $item['description'],
                'for_seller' => $item['for_seller'],
            ]);
            $introImage
                ->addMedia($item['image'])
                ->preservingOriginal()
                ->toMediaCollection(IntroImagesEnum::IMAGE->value);
        }
    }
}
