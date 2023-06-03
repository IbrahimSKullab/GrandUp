<?php

namespace App\Imports;

use Exception;
use App\Helper\Helper;
use App\Models\SellerProduct;
use Illuminate\Support\Collection;
use App\Services\Product\ProductServices;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportProduct implements ToCollection
{
    private $seller_id;

    public function __construct($seller_id)
    {
        $this->seller_id = $seller_id;
    }

    public function collection(Collection $collection)
    {
        $codes = $collection->skip(1)->map(function ($item) {
            return $item[0];
        })->toArray();

        foreach ($codes as $code) {
            $key = array_search($code, $codes);
            if ($key !== false) {
                unset($codes[$key]);
            }
            if (in_array($code, $codes)) {
                throw new Exception(__('There are more than product with code') . ' ' . $code);
            }
        }
        $collection->skip(1)->map(function ($item) {
            $product = SellerProduct::query()
                ->where('code', $item[0])
                ->where('seller_id', $this->seller_id)
                ->first();
            if (! is_null($product)) {
                $product->update([
                    'code' => $item[0],
                    'seller_id' => $this->seller_id,
                    'title' => [
                        'ar' => $item[1],
                        'en' => $item[1],
                    ],
                    'description' => [
                        'ar' => $item[2],
                        'en' => $item[2],
                    ],
                    'features_one' => $item[3],
                    'features_two' => $item[4],
                    'features_three' => $item[5],
                    'seller_category_id' => $item[6],
                    'points' => $item[7],
                    'product_size' => $item[8],
                    'status' => $item[9],
                    'new_product' => $item[10],
                    'price' => $item[11],
                    'special_price' => $item[12],
                    'video_link' => $item[13],
                ]);
            } else {
                $newProduct = SellerProduct::query()->create([
                    'code' => $item[0],
                    'seller_id' => $this->seller_id,
                    'title' => [
                        'ar' => $item[1],
                        'en' => $item[1],
                    ],
                    'description' => [
                        'ar' => $item[2],
                        'en' => $item[2],
                    ],
                    'features_one' => $item[3],
                    'features_two' => $item[4],
                    'features_three' => $item[5],
                    'seller_category_id' => $item[6],
                    'points' => $item[7],
                    'product_size' => $item[8],
                    'status' => $item[9],
                    'new_product' => $item[10],
                    'price' => $item[11],
                    'special_price' => $item[12],
                    'video_link' => $item[13],
                ]);

                $newProduct->refresh();

                $newProduct->update([
                    'product_dynamic_link' => Helper::createDynamicLink('product', $newProduct->id, 'show_product_screen'),
                ]);

                (new ProductServices())->handleProductQrCode($newProduct);
            }
        });
    }
}
