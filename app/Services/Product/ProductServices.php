<?php

namespace App\Services\Product;

use App\Models\Admin;
use App\Models\Color;
use App\Helper\Helper;
use App\Models\Seller;
use App\Enums\SellerEnum;
use App\Models\OrderItem;
use App\Enums\ProductEnum;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;
use App\Models\SellerProduct;
use App\Enums\FriedRequestEnum;
use App\Models\ProductExhibition;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\Product\ProductResource;
use App\Notifications\Admin\ProductRejectionNotification;
use App\Notifications\Seller\ProductApprovedNotification;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use App\Notifications\Admin\ProductNeedAdminApprovalNotification;

class ProductServices implements ServiceInterface
{
    public static function productCounts(): int
    {
        return DB::table('seller_products')
            ->where('admin_approval', 1)
            ->count();
    }

    public function get(): Collection
    {
        return SellerProduct::query()->latest()->get();
    }

    public function getNewProduct(){
        return $product = SellerProduct::active()->orderBy('created_at')->customPagination()->get();
    }

    public function getEnabledProducts($request = null): array
    {
        $activeOffers = [];

        $can_user_search_in_features = false;

        $authUser = Helper::getAuthUserFromAccessToken();

        if ($authUser) {
            $can_user_search_in_features = DB::table('users')
                ->where('id', $authUser?->id)
                ->where('enable_features_search', 1)
                ->exists();
        }

        if ($request->filled('is_offer') && $request->boolean('is_offer')) {
            $activeOffers = DB::table('product_offers')
                ->where('start_at', '<', now()->endOfDay()->format('Y-m-d H:i:s'))
                ->where('end_at', '>', now()->endOfDay()->format('Y-m-d H:i:s'))
                ->latest()
                ->select('seller_product_id')
                ->pluck('seller_product_id')
                ->unique()
                ->toArray();
        }

        $products = SellerProduct::query()
            ->whereRelation('seller', 'sellers.account_status', '=', SellerEnum::ACCEPTED->name)
            ->where('status', 1)
            ->where('admin_approval', 1)
            ->when($request->filled('seller_id'), function ($query) use ($request) {
                $query->where('seller_id', $request->seller_id);
            })
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            })
            ->when($request->filled('sub_category_id'), function ($query) use ($request) {
                $query->where('sub_category_id', $request->sub_category_id);
            })
            ->when($request->filled('search'), function ($query) use ($request, $can_user_search_in_features) {
                $query->where(function ($query2) use ($can_user_search_in_features) {
                    $query2
                        ->where('title->ar', 'LIKE', '%' . request()->search . '%')
                        ->orWhere('title->en', 'LIKE', '%' . request()->search . '%')
                        ->when($can_user_search_in_features, function ($query3) {
                            $query3->orWhere('features_one', 'LIKE', '%' . request()->search . '%')
                                ->orWhere('features_two', 'LIKE', '%' . request()->search . '%')
                                ->orWhere('features_three', 'LIKE', '%' . request()->search . '%');
                        });
                });
            })
            ->when($request->filled('code'), function ($query) use ($request) {
                $query->where('code', $request->code);
            })
            ->latest('seller_products.created_at')
            ->customPagination()
            ->get()
            ->filter(function (SellerProduct $product) use ($activeOffers) {
                if (request()->filled('is_offer') && request()->boolean('is_offer')) {
                    if (in_array($product->id, $activeOffers)) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return true;
                }
            })
            ->filter(function (SellerProduct $product) {
                $user = Helper::getAuthUserFromAccessToken();
                if ($user) {
                    if ($product->seller->is_public_store) {
                        return true;
                    } else {
                        return DB::table('friend_requests')
                            ->where('seller_id', $product->seller_id)
                            ->where('user_id', $user->id)
                            ->where('friendship_type', FriedRequestEnum::ORDINARY->name)
                            ->where('friend_request_accepted_from_seller', 1)
                            ->exists();
                    }
                } else {
                    if ($product->seller->is_public_store) {
                        return true;
                    } else {
                        return false;
                    }
                }
            });

        $products = $this->filterProductBasedOnUsersAndGovernorates($products);

        return [
            'count' => $products->count(),
            'products' => ProductResource::collection($products),
        ];
    }

    public function filterProductBasedOnUsersAndGovernorates($products)
    {
        $authUser = Helper::getAuthUserFromAccessToken();

        return $products->filter(function (SellerProduct $product) use ($authUser) {
            if ($product->category?->status == 0 || $product->subCategory?->status == 0) {
                return false;
            }

            return true;
        })
            ->filter(function (SellerProduct $product) use ($authUser) {
                if (request()->bearerToken()) {
                    if ($authUser) {
                        if ($product->category?->governorates()->count() > 0) {
                            return in_array($authUser?->governorate_id, $product->category->governorates()->pluck('governorate_id')->toArray());
                        }
                    }
                }

                return true;
            })
            ->filter(function (SellerProduct $product) use ($authUser) {
                if (request()->bearerToken()) {
                    if ($authUser) {
                        if ($product->category?->users()->count() > 0) {
                            return in_array($authUser?->id, $product->category->users()->pluck('user_id')->toArray());
                        }
                    }
                }

                return true;
            })
            ->filter(function (SellerProduct $product) use ($authUser) {
                if (request()->bearerToken()) {
                    if ($authUser) {
                        if ($product->subCategory?->users()->count() > 0) {
                            return in_array($authUser?->id, $product->subCategory->users()->pluck('user_id')->toArray());
                        }
                    }
                }

                return true;
            })
            ->filter(function (SellerProduct $product) use ($authUser) {
                if (request()->bearerToken()) {
                    if ($authUser) {
                        if ($product->subCategory?->governorates()->count() > 0) {
                            return in_array($authUser?->id, $product->subCategory->governorates()->pluck('governorate_id')->toArray());
                        }
                    }
                }

                return true;
            });
    }

    public function getSellerProducts(): Collection
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return $seller->products()->customPagination()->latest()->get();
    }

    public function getSellerProductsNewest(): Collection
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return $seller->newProducts()->customPagination()->latest()->get();
    }

    public function getCount(): int
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return $seller->products()->count();
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $product = SellerProduct::query()->create([
                'seller_id' => $request->seller_id,
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'special_price' => $request->special_price,
                'points' => $request->points,
                'admin_approval' => 0,
                'video_link' => $request->video_link,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'code' => $request->code,
                'features_one' => $request->features_one,
                'features_two' => $request->features_two,
                'features_three' => $request->features_three,
                'status' => $request->boolean('status'),
                'new_product' => $request->boolean('new_product'),
                'product_size' => $request->product_size,
            ]);

            $choice_options = [];
            if ($request->has('choice')) {
                foreach ($request->choice_no as $key => $no) {
                    $str = 'choice_options_' . $no;
                    $item['name'] = 'choice_' . $no;
                    $item['title'] = $request->choice[$key];
                    $item['options'] = explode(',', implode('|', $request[$str]));
                    array_push($choice_options, $item);
                }
            }
            $product->choice_options = json_encode($choice_options);
            //combinations start
            $options = [];
            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                $colors_active = 1;
                array_push($options, $request->colors);
            }
            if ($request->has('choice_no')) {
                foreach ($request->choice_no as $key => $no) {
                    $name = 'choice_options_' . $no;
                    $my_str = implode('|', $request[$name]);
                    array_push($options, explode(',', $my_str));
                }
            }
            //Generates the combinations of customer choice options

            $combinations = Helper::combinations($options);

            $variations = [];
            $stock_count = 0;
            if (count($combinations[0]) > 0) {
                foreach ($combinations as $key => $combination) {
                    $str = '';
                    foreach ($combination as $k => $item) {
                        if ($k > 0) {
                            $str .= '-' . str_replace(' ', '', $item);
                        } else {
                            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                $color_name = Color::where('code', $item)->first()->name;
                                $str .= $color_name;
                            } else {
                                $str .= str_replace(' ', '', $item);
                            }
                        }
                    }
                    $item = [];
                    $item['type'] = $str;
                    $item['price'] = $request['price_' . str_replace('.', '_', $str)];
                    $item['sku'] = $request['sku_' . str_replace('.', '_', $str)];
                    $item['qty'] = abs($request['qty_' . str_replace('.', '_', $str)]);
                    array_push($variations, $item);
                    $stock_count += $item['qty'];
                }
            } else {
                $stock_count = (integer)$request['current_stock'];
            }

            $product->save();

            if ($request->hasFile('image')) {
                $product->addMedia($request->image)->toMediaCollection(ProductEnum::PRODUCT_IMAGE_COLLECTION->name);
            }

            if ($request->has('images') && count($request->images) > 0) {
                foreach ($request->images as $image) {
                    $product->addMedia($image)->toMediaCollection(ProductEnum::PRODUCT_IMAGES_COLLECTION->name);
                }
            }

            //combinations end
            $product->variation = json_encode($variations);
            $product->attributes = json_encode($request->choice_attributes);
            $product->current_stock = abs($stock_count) ?: 0;

            $product->save();

            $product->update([
                'product_dynamic_link' => Helper::createDynamicLink('product', $product->id, 'show_product_screen'),
            ]);

            $this->handleProductQrCode($product);

            return $product;
        });
    }

    public function handleProductQrCode($product): void
    {
        $writer = new PngWriter();

        $text = 'product_name:' . $product->title;
        $text .= "\n";
        $text .= 'product_code:' . $product->code;

        $qrCode = QrCode::create($text)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(400)
            ->setMargin(5)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new \Endroid\QrCode\Color\Color(0, 0, 0))
            ->setBackgroundColor(new \Endroid\QrCode\Color\Color(255, 255, 255));

        $result = $writer->write($qrCode);

        $image = Str::uuid() . '.png';

        $result->saveToFile(storage_path("app/temp/$image"));

        $qrCode = storage_path("app/temp/$image");

        $product->addMedia($qrCode)->toMediaCollection(ProductEnum::PRODUCT_QR_CODE->name);
    }

    public function storeForSeller($request)
    {
        return DB::transaction(function () use ($request) {
            $input = $request->all();
            $user = auth()->user();

            if ($user->parent_id != 0) {
                $seller = Seller::where('id', $user->parent_id)->first();
            } else {
                $seller = auth()->user();
            }

            $input['is_share'] = Helper::getSwitchValue('is_shared', $input);

            $product = SellerProduct::query()->create([
                'seller_id' => $seller->id,
                'title' => [
                    'ar' => $request->title,
                    'en' => $request->title,
                ],
                'description' => [
                    'ar' => $request->description,
                    'en' => $request->description,
                ],
                'video_link' => $request->video_link,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'admin_approval' => 0,
                'price' => $request->price,
                'special_price' => $request->special_price,
                'code' => $request->code,
                'points' => $request->points,
                'new_product' => $request->boolean('new_product'),
                'status' => $request->boolean('status'),
                'product_size' => $request->product_size,
                'is_shared' => $input['is_share'],
            ]);

            if ($request->hasFile('image')) {
                $product->addMedia($request->image)->toMediaCollection(ProductEnum::PRODUCT_IMAGE_COLLECTION->name);
            }

            if ($request->has('images') && count($request->images) > 0) {
                foreach ($request->images as $image) {
                    $product->addMedia($image)->toMediaCollection(ProductEnum::PRODUCT_IMAGES_COLLECTION->name);
                }
            }

            $choice_options = [];
            if ($request->has('choice')) {
                foreach ($request->choice_no as $key => $no) {
                    $item['attribute_id'] = $no;
                    $str = 'choice_options_' . $no;
                    $item['name'] = 'choice_' . $no;
                    $item['title'] = $request->choice[$key];
                    $item['options'] = explode(',', implode('|', $request[$str]));
                    array_push($choice_options, $item);
                }
            }
            $product->choice_options = json_encode($choice_options);
            //combinations start
            $options = [];
            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                $colors_active = 1;
                array_push($options, $request->colors);
            }
            if ($request->has('choice_no')) {
                foreach ($request->choice_no as $key => $no) {
                    $name = 'choice_options_' . $no;
                    $my_str = implode('|', $request[$name]);
                    array_push($options, explode(',', $my_str));
                }
            }
            //Generates the combinations of customer choice options

            $combinations = Helper::combinations($options);

            $variations = [];
            $stock_count = 0;
            if (count($combinations[0]) > 0) {
                foreach ($combinations as $key => $combination) {
                    $str = '';
                    foreach ($combination as $k => $item) {
                        if ($k > 0) {
                            $str .= '-' . str_replace(' ', '', $item);
                        } else {
                            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                $color_name = Color::where('code', $item)->first()->name;
                                $str .= $color_name;
                            } else {
                                $str .= str_replace(' ', '', $item);
                            }
                        }
                    }
                    $item = [];
                    $item['type'] = $str;
                    $item['price'] = $request['price_' . str_replace('.', '_', $str)];
                    $item['sku'] = $request['sku_' . str_replace('.', '_', $str)];
                    $item['qty'] = abs($request['qty_' . str_replace('.', '_', $str)]);
                    array_push($variations, $item);
                    $stock_count += $item['qty'];
                }
            } else {
                $stock_count = (integer)$request['current_stock'];
            }

            //combinations end
            $product->variation = json_encode($variations);
            $product->attributes = json_encode($request->choice_attributes);
            $product->current_stock = abs($stock_count) ?: 0;

            $product->save();

            $product->update([
                'product_dynamic_link' => Helper::createDynamicLink('product', $product->id, 'show_product_screen'),
            ]);

            $this->handleProductQrCode($product);

            $this->handleNotificationAdmins($product);

            return $product;
        });
    }

    private function handleNotificationAdmins($product, $is_create = true)
    {
        $admins = Admin::query()->where('status', 1)->where('is_staff', 1)->get();
        foreach ($admins as $admin) {
            if ($admin->hasPermissionTo('catalog')) {
                $admin->notify(new ProductNeedAdminApprovalNotification($product, $is_create));
            }
        }
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $product = $this->findById($id);

            $product->update([
                'seller_id' => $request->seller_id,
                'title' => $request->title,
                'description' => $request->description,
                'code' => $request->code,
                'video_link' => $request->video_link,
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'price' => $request->price,
                'special_price' => $request->special_price,
                'points' => $request->points,
                'features_one' => $request->features_one,
                'features_two' => $request->features_two,
                'features_three' => $request->features_three,
                'new_product' => $request->boolean('new_product'),
                'status' => $request->boolean('status'),
                'product_size' => $request->product_size,
            ]);

            $choice_options = [];
            if ($request->has('choice')) {
                foreach ($request->choice_no as $key => $no) {
                    $str = 'choice_options_' . $no;
                    $item['attribute_id'] = $no;
                    $item['name'] = 'choice_' . $no;
                    $item['title'] = $request->choice[$key];
                    $item['options'] = explode(',', implode('|', $request[$str]));
                    array_push($choice_options, $item);
                }
            }
            $product->choice_options = json_encode($choice_options);
            //combinations start
            $options = [];
            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                $colors_active = 1;
                array_push($options, $request->colors);
            }
            if ($request->has('choice_no')) {
                foreach ($request->choice_no as $key => $no) {
                    $name = 'choice_options_' . $no;
                    $my_str = implode('|', $request[$name]);
                    array_push($options, explode(',', $my_str));
                }
            }
            //Generates the combinations of customer choice options

            $combinations = Helper::combinations($options);

            $variations = [];
            $stock_count = 0;
            if (count($combinations[0]) > 0) {
                foreach ($combinations as $key => $combination) {
                    $str = '';
                    foreach ($combination as $k => $item) {
                        if ($k > 0) {
                            $str .= '-' . str_replace(' ', '', $item);
                        } else {
                            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                $color_name = Color::where('code', $item)->first()->name;
                                $str .= $color_name;
                            } else {
                                $str .= str_replace(' ', '', $item);
                            }
                        }
                    }
                    $item = [];
                    $item['type'] = $str;
                    $item['price'] = $request['price_' . str_replace('.', '_', $str)];
                    $item['sku'] = $request['sku_' . str_replace('.', '_', $str)];
                    $item['qty'] = abs($request['qty_' . str_replace('.', '_', $str)]);
                    array_push($variations, $item);
                    $stock_count += $item['qty'];
                }
            } else {
                $stock_count = (integer)$request['current_stock'];
            }

            if ($request->hasFile('image')) {
                $product->addMedia($request->image)->toMediaCollection(ProductEnum::PRODUCT_IMAGE_COLLECTION->name);
            }

            if ($request->has('images') && count($request->images) > 0) {
                foreach ($request->images as $image) {
                    $product->addMedia($image)->toMediaCollection(ProductEnum::PRODUCT_IMAGES_COLLECTION->name);
                }
            }

            //combinations end
            $product->variation = json_encode($variations);
            $product->attributes = json_encode($request->choice_attributes);
            $product->current_stock = abs($stock_count) ?: 0;

            $product->save();

            $this->handleProductQrCode($product);

            $this->handleNotificationAdmins($product);

            return $product;
        });
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return SellerProduct::query()
                ->whereRelation('seller', 'sellers.account_status', '=', SellerEnum::ACCEPTED->name)
                ->where('status', 1)
                ->where('admin_approval', 1)
                ->findOrFail($id);
        }

        return SellerProduct::query()->findOrFail($id);
    }

    public function updateForSeller($request, $id)
    {
        if ($request->product_id) {
            $product = $this->findSellerProductById($id);

            $product->update([
                'price' => $request->price,
            ]);

        } else {
            return DB::transaction(function () use ($request, $id) {
                $input = $request->all();

                $product = $this->findSellerProductById($id);

                $input['is_share'] = Helper::getSwitchValue('is_shared', $input);

                $product->update([
                    'title' => [
                        'ar' => $request->title,
                    ],
                    'description' => [
                        'ar' => $request->description,
                    ],
                    'video_link' => $request->video_link,
                    'category_id' => $request->category_id,
                    'sub_category_id' => $request->sub_category_id,
                    'price' => $request->price,
                    'code' => $request->code,
                    'admin_approval' => 0,
                    'product_rejected' => 0,
                    'special_price' => $request->special_price,
                    'points' => $request->points,
                    'new_product' => $request->filled('new_product') ? $request->boolean('new_product') : $product->new_product,
                    'status' => $request->filled('status') ? $request->boolean('status') : $product->status,
                    'product_size' => $request->product_size,
                    'is_shared' => $input['is_share'],
                ]);

                $choice_options = [];
                if ($request->has('choice')) {
                    foreach ($request->choice_no as $key => $no) {
                        $str = 'choice_options_' . $no;
                        $item['name'] = 'choice_' . $no;
                        $item['title'] = $request->choice[$key];
                        $item['options'] = explode(',', implode('|', $request[$str]));
                        array_push($choice_options, $item);
                    }
                }
                $product->choice_options = json_encode($choice_options);
                //combinations start
                $options = [];
                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                    $colors_active = 1;
                    array_push($options, $request->colors);
                }
                if ($request->has('choice_no')) {
                    foreach ($request->choice_no as $key => $no) {
                        $name = 'choice_options_' . $no;
                        $my_str = implode('|', $request[$name]);
                        array_push($options, explode(',', $my_str));
                    }
                }
                //Generates the combinations of customer choice options

                $combinations = Helper::combinations($options);

                $variations = [];
                $stock_count = 0;
                if (count($combinations[0]) > 0) {
                    foreach ($combinations as $key => $combination) {
                        $str = '';
                        foreach ($combination as $k => $item) {
                            if ($k > 0) {
                                $str .= '-' . str_replace(' ', '', $item);
                            } else {
                                if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
                                    $color_name = Color::where('code', $item)->first()->name;
                                    $str .= $color_name;
                                } else {
                                    $str .= str_replace(' ', '', $item);
                                }
                            }
                        }
                        $item = [];
                        $item['type'] = $str;
                        $item['price'] = $request['price_' . str_replace('.', '_', $str)];
                        $item['sku'] = $request['sku_' . str_replace('.', '_', $str)];
                        $item['qty'] = abs($request['qty_' . str_replace('.', '_', $str)]);
                        array_push($variations, $item);
                        $stock_count += $item['qty'];
                    }
                } else {
                    $stock_count = (integer)$request['current_stock'];
                }

                if ($request->hasFile('image')) {
                    $product->addMedia($request->image)->toMediaCollection(ProductEnum::PRODUCT_IMAGE_COLLECTION->name);
                }

                if ($request->has('images') && count($request->images) > 0) {
                    foreach ($request->images as $image) {
                        $product->addMedia($image)->toMediaCollection(ProductEnum::PRODUCT_IMAGES_COLLECTION->name);
                    }
                }

                //combinations end
                $product->variation = json_encode($variations);
                $product->attributes = json_encode($request->choice_attributes);
                $product->current_stock = abs($stock_count) ?: 0;

                $product->save();

                $this->handleProductQrCode($product);

                $this->handleNotificationAdmins($product, is_create: false);

                return $product;
            });
        }
    }

    public function findSellerProductById($id, $checkStatus = false): Model
    {
        $user = auth()->user();

        if ($user->parent_id != 0) {
            $seller = Seller::where('id', $user->parent_id)->first();
        } else {
            $seller = auth()->user();
        }

        return $seller->products()->findOrFail($id);
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $product = $this->findById($id);

            $product->delete();
        });
    }

    public function destroyForSeller($id)
    {
        return DB::transaction(function () use ($id) {
            $product = $this->findSellerProductById($id);

            $product->delete();
        });
    }

    public function toggleStatusForSeller($id)
    {
        return DB::transaction(function () use ($id) {
            $product = $this->findSellerProductById($id);

            $product->update([
                'status' => ! $product->status,
            ]);
        });
    }

    public function approveProduct($id)
    {
        return DB::transaction(function () use ($id) {
            $product = $this->findById($id);

            $product->update([
                'admin_approval' => 1,
                'product_rejected' => 0,
            ]);

            $product->refresh();

            $product->seller->notify(new ProductApprovedNotification($product));
        });
    }

    public function rejectProduct($id)
    {
        return DB::transaction(function () use ($id) {
            $product = $this->findById($id);

            $product->update([
                'admin_approval' => 0,
                'product_rejected' => 1,
                'rejection_reason' => request()->rejection_reason,
            ]);

            $product->seller->notify(new ProductRejectionNotification($product));
        });
    }

    public function getGeneralProduct()
    {
        $general_product = SellerProduct::with('seller')->whereHas('seller', function ($query) {
            return $query->where('is_public_store', 1)->planExpiredAt();
        })->active()->newest()->latest()->customPagination()->get();

        return $general_product;
    }

    public function getGeneralProductPoint()
    {
        return $general_product = SellerProduct::with('seller')->whereHas('seller', function ($query) {
            return $query->where('is_public_store', 1)->planExpiredAt();
        })->active()->point()->latest()->customPagination()->get();
    }

    public function getExhibitionProduct()
    {
        $offer_product = ProductExhibition::with('seller')->whereHas('seller', function ($query) {
            return $query->where('is_public_store', 1)->planExpiredAt();
        })->where('seller_type', 'general')->where('end_at', '>=', now())->pluck('seller_product_id')->toArray();

        return $products = SellerProduct::whereIn('id', $offer_product)->active()->latest()->customPagination()->get();
    }

    public function getProductByCategoryId($id, $general = false)
    {
        return $general_product = SellerProduct::when($general == true, function ($q) {
            return $q->whereHas('seller', function ($query) {
                return $query->where('is_public_store', 1)->planExpiredAt();
            });
        })->where('category_id', $id)->active()->newest()->latest()->customPagination()->get();
    }

    public function getProductBySubCategoryId($id, $general = false)
    {
//        $store_id = null,
        return $general_product = SellerProduct::when($general == true, function ($q) {
            return $q->whereHas('seller', function ($query) {
                $query->where('is_public_store', 1)->planExpiredAt();
            });
        })->where('sub_category_id', $id)->active()->newest()->latest()->customPagination()->get();
    }

    public function getProductStoreByCategoryId($id, $store_id, $general = false)
    {
        return $general_product = SellerProduct::when($general == true, function ($q) {
            return $q->whereHas('seller', function ($query) {
                $query->where('is_public_store', 1)->planExpiredAt();
            });
        })->where('seller_id', $store_id)->where('category_id', $id)->active()->latest()->customPagination()->get();
    }

    public function getProductStoreBySubCategoryId($id, $store_id = null, $general = false)
    {
        return $general_product = SellerProduct::when($general == true, function ($q) {
            return $q->whereHas('seller', function ($query) {
                $query->where('is_public_store', 1)->planExpiredAt();
            });
        })->where('seller_id', $store_id)->where('sub_category_id', $id)->active()->latest()->customPagination()->get();
    }

    public function getProductStoreNew($general = false)
    {
        return $general_product = SellerProduct::when($general == true, function ($q) {
            return $q->whereHas('seller', function ($query) {
                $query->where('is_public_store', 1)->planExpiredAt();
            });
        })->newest()->active()->latest()->customPagination()->get();
    }

    public function getProductStore($store_id = null, $general = false)
    {
        return $general_product = SellerProduct::when($general == true, function ($q) {
            return $q->whereHas('seller', function ($query) {
                $query->where('is_public_store', 1)->planExpiredAt();
            });
        })->where('seller_id', $store_id)->active()->latest()->customPagination()->get();
    }

    public function getBestSellingProduct($general = false)
    {
        return $product = OrderItem::with('product')
            ->whereHas('product', function ($query) {
                $query->active();
            })
            ->select('seller_product_id', DB::raw('COUNT(seller_product_id) as count'))
            ->groupBy('seller_product_id')
            ->orderBy('count', 'desc')
            ->customPagination()->get();
    }

    public function storeVariation($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $product = $this->findSellerProductById($id);
            $choice_options = [];
            if ($request->has('choice')) {
                foreach ($request->choice_no as $key => $no) {
                    $str = 'choice_options_' . $no;
                    $item['name'] = 'choice_' . $no;
                    $item['title'] = $request->choice[$key];
                    $item['options'] = explode(',', implode('|', $request[$str]));
                    array_push($choice_options, $item);
                }
            }
            $product->choice_options = json_encode($choice_options);
            //combinations start
            $options = [];
//            if ($request->has('colors_active') && $request->has('colors') && count($request->colors) > 0) {
//                $colors_active = 1;
//                array_push($options, $request->colors);
//            }
            if ($request->has('choice_no')) {
                foreach ($request->choice_no as $key => $no) {
                    $name = 'choice_options_' . $no;
                    $my_str = implode('|', $request[$name]);
                    array_push($options, explode(',', $my_str));
                }
            }

            //Generates the combinations of customer choice options

            $combinations = Helper::combinations($options);

            $variations = [];
            $stock_count = 0;
            if (count($combinations[0]) > 0) {
                foreach ($combinations as $key => $combination) {
                    $str = '';
                    foreach ($combination as $k => $item) {
                        if ($k > 0) {
                            $str .= '-' . str_replace(' ', '', $item);
                        } else {
                            $str .= str_replace(' ', '', $item);
                        }
                    }
                    $item = [];
                    $item['type'] = $str;
                    $item['price'] = $request['price_' . str_replace('.', '_', $str)];
                    $item['sku'] = $request['sku_' . str_replace('.', '_', $str)];
                    $item['qty'] = abs($request['qty_' . str_replace('.', '_', $str)]);
                    array_push($variations, $item);
                    $stock_count += $item['qty'];
                }
            } else {
                $stock_count = (integer)$request['current_stock'];
            }

            //combinations end
            $product->variation = json_encode($variations);
            $product->attributes = json_encode($request->choice_attributes);
            $product->current_stock = abs($stock_count) ?: 0;

            $product->save();

            return $product;
        });
    }
}
