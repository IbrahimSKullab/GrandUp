<?php

namespace Database\Seeders;

use App\Helper\Helper;
use App\Models\Category;
use App\Enums\ProductEnum;
use App\Models\SubCategory;
use App\Models\SellerProduct;
use Illuminate\Database\Seeder;
use App\Services\Product\ProductServices;

class SellerProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'title' => [
                    'ar' => 'المنتج الأول',
                    'en' => 'First Product',
                ],
                'description' => [
                    'ar' => 'تفاصيل المنتج الأول',
                    'en' => 'First Product Description',
                ],
                'status' => 1,
                'new_product' => 1,

                'admin_approval' => 1,

                'price' => 100,
                'special_price' => 80,
                'points' => 100,
                'image' => public_path('test_images/products/01.jpg'),
                'images' => [
                    public_path('test_images/products/02.jpg'),
                    public_path('test_images/products/03.jpg'),
                    public_path('test_images/products/04.jpg'),
                ],
            ],
            [
                'title' => [
                    'ar' => 'المنتج الثاني',
                    'en' => 'Second Product',
                ],
                'description' => [
                    'ar' => 'تفاصيل المنتج الثاني',
                    'en' => 'Second Product Description',
                ],
                'status' => 1,
                'new_product' => 1,

                'admin_approval' => 1,

                'price' => 120,
                'special_price' => 100,
                'points' => 120,
                'image' => public_path('test_images/products/02.jpg'),
                'images' => [
                    public_path('test_images/products/03.jpg'),
                    public_path('test_images/products/04.jpg'),
                    public_path('test_images/products/05.jpg'),
                ],
            ],
            [
                'title' => [
                    'ar' => 'المنتج الثالث',
                    'en' => 'Third Product',
                ],
                'description' => [
                    'ar' => 'تفاصيل المنتج الثالث',
                    'en' => 'Third Product Description',
                ],
                'status' => 1,
                'new_product' => 1,

                'admin_approval' => 1,

                'price' => 150,
                'special_price' => 130,
                'points' => 150,
                'image' => public_path('test_images/products/03.jpg'),
                'images' => [
                    public_path('test_images/products/04.jpg'),
                    public_path('test_images/products/05.jpg'),
                    public_path('test_images/products/06.jpg'),
                ],
            ],
            [
                'title' => [
                    'ar' => 'المنتج الرابع',
                    'en' => 'Fourth Product',
                ],
                'description' => [
                    'ar' => 'تفاصيل المنتج الرابع',
                    'en' => 'Fourth Product Description',
                ],
                'status' => 1,
                'new_product' => 1,

                'admin_approval' => 1,

                'price' => 100,
                'special_price' => 80,
                'points' => 100,
                'image' => public_path('test_images/products/04.jpg'),
                'images' => [
                    public_path('test_images/products/05.jpg'),
                    public_path('test_images/products/06.jpg'),
                    public_path('test_images/products/07.jpg'),
                ],
            ],
            [
                'title' => [
                    'ar' => 'المنتج الخامس',
                    'en' => 'Fifth Product',
                ],
                'description' => [
                    'ar' => 'تفاصيل المنتج الخامس',
                    'en' => 'Fifth Product Description',
                ],
                'status' => 1,
                'new_product' => 1,

                'admin_approval' => 1,

                'price' => 200,
                'special_price' => 190,
                'points' => 200,
                'image' => public_path('test_images/products/05.jpg'),
                'images' => [
                    public_path('test_images/products/06.jpg'),
                    public_path('test_images/products/07.jpg'),
                    public_path('test_images/products/08.jpg'),
                ],
            ],
            [
                'title' => [
                    'ar' => 'المنتج السادس',
                    'en' => 'Sixth Product',
                ],
                'description' => [
                    'ar' => 'تفاصيل المنتج السادس',
                    'en' => 'Sixth Product Description',
                ],
                'status' => 1,
                'new_product' => 1,

                'admin_approval' => 1,

                'price' => 500,
                'special_price' => 450,
                'points' => 900,
                'image' => public_path('test_images/products/06.jpg'),
                'images' => [
                    public_path('test_images/products/07.jpg'),
                    public_path('test_images/products/08.jpg'),
                    public_path('test_images/products/09.jpg'),
                ],
            ],
            [
                'title' => [
                    'ar' => 'المنتج السابع',
                    'en' => 'Seventh Product',
                ],
                'description' => [
                    'ar' => 'تفاصيل المنتج السابع',
                    'en' => 'Seventh Product Description',
                ],
                'status' => 1,
                'new_product' => 1,

                'admin_approval' => 1,

                'price' => 1000,
                'special_price' => 900,
                'points' => 1200,
                'image' => public_path('test_images/products/07.jpg'),
                'images' => [
                    public_path('test_images/products/08.jpg'),
                    public_path('test_images/products/09.jpg'),
                    public_path('test_images/products/10.jpg'),
                ],
            ],
            [
                'title' => [
                    'ar' => 'المنتج الثامن',
                    'en' => 'Eighth Product',
                ],
                'description' => [
                    'ar' => 'تفاصيل المنتج الثامن',
                    'en' => 'Eighth Product Description',
                ],
                'status' => 1,
                'new_product' => 1,

                'admin_approval' => 1,

                'price' => 520,
                'special_price' => 500,
                'image' => public_path('test_images/products/08.jpg'),
                'images' => [
                    public_path('test_images/products/09.jpg'),
                    public_path('test_images/products/10.jpg'),
                    public_path('test_images/products/01.jpg'),
                ],
            ],
            [
                'title' => [
                    'ar' => 'المنتج التاسع',
                    'en' => 'Ninth Product',
                ],
                'description' => [
                    'ar' => 'تفاصيل المنتج التاسع',
                    'en' => 'Ninth Product Description',
                ],
                'status' => 1,
                'new_product' => 1,

                'admin_approval' => 1,

                'price' => 850,
                'special_price' => 700,
                'image' => public_path('test_images/products/09.jpg'),
                'images' => [
                    public_path('test_images/products/10.jpg'),
                    public_path('test_images/products/01.jpg'),
                    public_path('test_images/products/02.jpg'),
                ],
            ],
            [
                'title' => [
                    'ar' => 'المنتج العاشر',
                    'en' => 'Tenth Product',
                ],
                'description' => [
                    'ar' => 'تفاصيل المنتج العاشر',
                    'en' => 'Tenth Product Description',
                ],
                'status' => 1,
                'new_product' => 1,

                'admin_approval' => 1,

                'price' => 100,
                'special_price' => 80,
                'image' => public_path('test_images/products/10.jpg'),
                'images' => [
                    public_path('test_images/products/01.jpg'),
                    public_path('test_images/products/02.jpg'),
                    public_path('test_images/products/03.jpg'),
                ],
            ],
        ];

        $i = 1;
        foreach ($products as $product) {
            $randCategory = Category::query()->inRandomOrder()->first();
            $createdProduct = SellerProduct::query()->create([
                'seller_id' => 1,
                'category_id' => $randCategory->id,
                'sub_category_id' => SubCategory::query()->where('category_id', $randCategory->id)->inRandomOrder()->first()->id,
                'title' => $product['title'],
                'description' => $product['title'],
                'status' => $product['status'],
                'new_product' => $product['new_product'],
                'admin_approval' => $product['admin_approval'],
                'code' => '000' . $i,
                'price' => $product['price'],
                'special_price' => $product['special_price'],
                'points' => $product['points'] ?? null,
            ]);

            $createdProduct->addMedia($product['image'])->preservingOriginal()->toMediaCollection(ProductEnum::PRODUCT_IMAGE_COLLECTION->name);

            (new ProductServices())->handleProductQrCode($createdProduct);

            foreach ($product['images'] as $image) {
                $createdProduct->addMedia($image)->preservingOriginal()->toMediaCollection(ProductEnum::PRODUCT_IMAGES_COLLECTION->name);
            }

            $createdProduct->update([
                'product_dynamic_link' => Helper::createDynamicLink('product', $createdProduct->id, 'show_product_screen'),
            ]);

            $i++;
        }

        $ii = 11;
        foreach ($products as $product) {
            $randCategory = Category::query()->inRandomOrder()->first();
            $createdProduct = SellerProduct::query()->create([
                'seller_id' => 2,
                'category_id' => $randCategory->id,
                'sub_category_id' => SubCategory::query()->where('category_id', $randCategory->id)->inRandomOrder()->first()->id,
                'title' => $product['title'],
                'description' => $product['title'],
                'status' => $product['status'],
                'new_product' => $product['new_product'],
                'admin_approval' => $product['admin_approval'],
                'code' => '000' . $ii,
                'price' => $product['price'],
                'special_price' => $product['special_price'],
                'points' => $product['points'] ?? null,
            ]);

            $createdProduct->addMedia($product['image'])->preservingOriginal()->toMediaCollection(ProductEnum::PRODUCT_IMAGE_COLLECTION->name);

            foreach ($product['images'] as $image) {
                $createdProduct->addMedia($image)->preservingOriginal()->toMediaCollection(ProductEnum::PRODUCT_IMAGES_COLLECTION->name);
            }

            $createdProduct->update([
                'product_dynamic_link' => Helper::createDynamicLink('product', $createdProduct->id, 'show_product_screen'),
            ]);

            (new ProductServices())->handleProductQrCode($createdProduct);

            $ii++;
        }
    }
}
