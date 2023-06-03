<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Enums\CategoryEnum;
use App\Models\SubCategory;
use App\Enums\SubCategoryEnum;
use Illuminate\Database\Seeder;

class CategoryAndSubCategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'title' => [
                    'ar' => 'القسم الأول',
                    'en' => 'First Category',
                ],
                'image' => public_path('test_images/products/01.jpg'),
                'subcategories' => [
                    [
                        'title' => [
                            'ar' => 'القسم الفرعي الأول - 1',
                            'en' => 'First Sub Category - 1',
                        ],
                    ],
                    [
                        'title' => [
                            'ar' => 'القسم الفرعي الثاني - 1',
                            'en' => 'Second Sub Category - 1',
                        ],
                    ],
                ],
            ],
            [
                'title' => [
                    'ar' => 'القسم الثاني',
                    'en' => 'Second Category',
                ],
                'image' => public_path('test_images/products/02.jpg'),
                'subcategories' => [
                    [
                        'title' => [
                            'ar' => 'القسم الفرعي الأول - 2',
                            'en' => 'First Sub Category - 2',
                        ],
                    ],
                    [
                        'title' => [
                            'ar' => 'القسم الفرعي الثاني - 2',
                            'en' => 'Second Sub Category - 2',
                        ],
                    ],
                ],
            ],
            [
                'title' => [
                    'ar' => 'القسم الثالث',
                    'en' => 'First Category',
                ],
                'image' => public_path('test_images/products/03.jpg'),
                'subcategories' => [
                    [
                        'title' => [
                            'ar' => 'القسم الفرعي الأول - 3',
                            'en' => 'First Sub Category - 3',
                        ],
                    ],
                    [
                        'title' => [
                            'ar' => 'القسم الفرعي الثاني - 3',
                            'en' => 'Second Sub Category - 3',
                        ],
                    ],
                ],
            ],
            [
                'title' => [
                    'ar' => 'القسم الرابع',
                    'en' => 'Fourth Category',
                ],
                'image' => public_path('test_images/products/04.jpg'),
                'subcategories' => [
                    [
                        'title' => [
                            'ar' => 'القسم الفرعي الأول - 4',
                            'en' => 'First Sub Category - 4',
                        ],
                    ],
                    [
                        'title' => [
                            'ar' => 'القسم الفرعي الثاني - 4',
                            'en' => 'Second Sub Category - 4',
                        ],
                    ],
                ],
            ],
        ];

        foreach ($categories as $category) {
            $createdCategory = Category::query()->create([
                'title' => $category['title'],
                'status' => 1,
            ]);

            $createdCategory->addMedia($category['image'])->preservingOriginal()->toMediaCollection(CategoryEnum::CATEGORY_COLLECTION->name);

            foreach ($category['subcategories'] as $sub) {
                $createdSubCategory = SubCategory::query()->create([

                    'title' => $sub['title'],
                    'status' => 1,
                    'category_id' => $createdCategory->id,
                ]);
                $createdSubCategory->addMedia($category['image'])->preservingOriginal()->toMediaCollection(SubCategoryEnum::SUB_CATEGORY_COLLECTION->name);
            }
        }

        foreach ($categories as $category) {
            $createdCategory = Category::query()->create([
                'title' => $category['title'],
                'status' => 1,
            ]);
            $createdCategory->addMedia($category['image'])->preservingOriginal()->toMediaCollection(CategoryEnum::CATEGORY_COLLECTION->name);

            foreach ($category['subcategories'] as $sub) {
                $createdSubCategory = SubCategory::query()->create([
                    'title' => $sub['title'],
                    'status' => 1,
                    'category_id' => $createdCategory->id,
                ]);
                $createdSubCategory->addMedia($category['image'])->preservingOriginal()->toMediaCollection(SubCategoryEnum::SUB_CATEGORY_COLLECTION->name);
            }
        }
    }
}
