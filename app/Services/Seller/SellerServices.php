<?php

namespace App\Services\Seller;

use App\Helper\Helper;
use App\Models\Seller;
use App\Enums\UserEnum;
use App\Enums\SellerEnum;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;
use Endroid\QrCode\Color\Color;
use App\Services\ServiceInterface;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Database\Eloquent\Model;
use App\Services\Product\ProductServices;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Resources\Product\ProductResource;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;

class SellerServices implements ServiceInterface
{
    public function get(): Collection
    {
        return Seller::query()->planExpiredAt()->latest()->orderBy('order')->get();
    }

    public function getEnabledSellers($limit = null): Collection
    {
        return Seller::query()
            ->sellerLocal()
            ->planExpiredAt()
            ->orderBy('order')
            ->when(request()->filled('from') && request()->from != '' && request()->filled('to') && request()->to != '', function ($query) {
                $from = (int)request()->from;
                $to = (int)request()->to;
                $total = $to - $from + 1;
                $skip = $from - 1;
                $query->skip($skip)->take($total);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->take($limit);
            })
            ->when(request()->filled('search') && request()->search != '', function ($query) {
                $query->where('name', 'LIKE', '%' . request()->search . '%');
            })
            ->where('account_status', SellerEnum::ACCEPTED->name)
            ->get();
    }

    public function count(): int
    {
        return Seller::query()
            ->planExpiredAt()
            ->orderBy('order')
            ->when(request()->filled('search') && request()->search != '', function ($query) {
                $query->where('name', 'LIKE', '%' . request()->search . '%');
            })
            ->where('account_status', SellerEnum::ACCEPTED->name)
            ->count();
    }

    public function getNewProducts($seller_id): array
    {
        $seller = $this->findById($seller_id);
        $productsCount = $seller
            ->newProducts()
            ->when(request()->filled('category_id'), function ($query) {
                $query->where('seller_category_id', request()->category_id);
            })
            ->when(request()->filled('sub_category_id'), function ($query) {
                if (request()->filled('category_id')) {
                    $query
                        ->where('seller_sub_category_id', request()->sub_category_id)
                        ->where('seller_category_id', request()->category_id);
                } else {
                    $query->where('seller_sub_category_id', request()->sub_category_id);
                }
            })
            ->count();
        $products = $seller
            ->newProducts()
            ->when(request()->filled('from') && request()->from != '' && request()->filled('to') && request()->to != '', function ($query) {
                $from = (int)request()->from;
                $to = (int)request()->to;
                $total = $to - $from + 1;
                $skip = $from - 1;
                $query->skip($skip)->take($total);
            })
            ->when(request()->filled('category_id'), function ($query) {
                $query->where('seller_category_id', request()->category_id);
            })
            ->when(request()->filled('sub_category_id'), function ($query) {
                $query->where('seller_sub_category_id', request()->sub_category_id);
            })
            ->get();

        $products = (new ProductServices())->filterProductBasedOnUsersAndGovernorates($products);

        return [
            'count' => $productsCount,
            'products' => ProductResource::collection($products),
        ];
    }

    public function getProductWithPoints($seller_id): array
    {
        $seller = $this->findById($seller_id);
        $productsCount = $seller
            ->productPoints()
            ->when(request()->filled('category_id'), function ($query) {
                $query->where('seller_category_id', request()->category_id);
            })
            ->when(request()->filled('sub_category_id'), function ($query) {
                $query->where('seller_sub_category_id', request()->sub_category_id);
            })
            ->count();
        $products = $seller
            ->productPoints()
            ->when(request()->filled('from') && request()->from != '' && request()->filled('to') && request()->to != '', function ($query) {
                $from = (int)request()->from;
                $to = (int)request()->to;
                $total = $to - $from + 1;
                $skip = $from - 1;
                $query->skip($skip)->take($total);
            })
            ->when(request()->filled('category_id'), function ($query) {
                $query->where('seller_category_id', request()->category_id);
            })
            ->when(request()->filled('sub_category_id'), function ($query) {
                $query->where('seller_sub_category_id', request()->sub_category_id);
            })
            ->get();

        $products = (new ProductServices())->filterProductBasedOnUsersAndGovernorates($products);

        return [
            'count' => $productsCount,
            'products' => ProductResource::collection($products),
        ];
    }

    public function getOtherProducts($seller_id): array
    {
        $seller = $this->findById($seller_id);
        $productsCount = $seller
            ->otherProducts()
            ->when(request()->filled('category_id'), function ($query) {
                $query->where('seller_category_id', request()->category_id);
            })
            ->when(request()->filled('sub_category_id'), function ($query) {
                $query->where('seller_sub_category_id', request()->sub_category_id);
            })
            ->count();
        $products = $seller
            ->otherProducts()
            ->when(request()->filled('from') && request()->from != '' && request()->filled('to') && request()->to != '', function ($query) {
                $from = (int)request()->from;
                $to = (int)request()->to;
                $total = $to - $from + 1;
                $skip = $from - 1;
                $query->skip($skip)->take($total);
            })
            ->get();

        $products = (new ProductServices())->filterProductBasedOnUsersAndGovernorates($products);

        return [
            'count' => $productsCount,
            'products' => ProductResource::collection($products),
        ];
    }

    public function findById($id, $checkStatus = false): Model
    {
        if ($checkStatus) {
            return Seller::query()->planExpiredAt()->where('account_status', SellerEnum::ACCEPTED->name)->findOrFail($id);
        }

        return Seller::query()->findOrFail($id);
    }

    public function findByPhone($phone): Model
    {
        return Seller::query()->planExpiredAt()->where('phone', $phone)->firstOrFail();
    }

    public function store($request)
    {
        return DB::transaction(function () use ($request) {
            $seller = Seller::query()->create([
                'order' => $request->order,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'whatsapp_number' => $request->phone,
                'description' => $request->description,
                'location' => $request->location,
                'store_number' => mt_rand(10000000, 99999999),
                'is_public_store' => $request->is_public_store,
                'time_to' => $request->time_to,
                'time_from' => $request->time_from,
                'hashed_login_otp' => null,
                'account_status' => SellerEnum::REQUIRE_APPROVAL->name,
                'governorate_id' => $request->governorate_id,
                'country_id' => $request->country_id,
                'store_gps_location' => $request->store_gps_location,
                'default_currency' => $request->default_currency,
                'seller_code' => $request->seller_code,
                'app_version' => $request->app_version,
                'device_token' => $request->device_token,
                'device_type' => $request->device_type,
                'password' => $request->filled('password') ? Hash::make($request->password) : null,
            ]);

            $seller->classifications()->sync($request->categories ?? []);

            if ($request->hasFile('profile_image')) {
                $seller->addMedia($request->profile_image)->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
            }

            $dynamicLink = Helper::createDynamicLink('seller', $seller->id, 'show_seller_screen');

            $seller->update([
                'seller_dynamic_link' => $dynamicLink,
            ]);

            $this->handleProductQrCode($seller);

            return $seller;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $seller = $this->findById($id);

            $seller->update([
                'order' => $request->order,
                'name' => $request->name,
                'store_number' => $request->store_number,
                'is_public_store' => $request->is_public_store,
                'time_to' => $request->time_to,
                'time_from' => $request->time_from,
                'governorate_id' => $request->governorate_id,
                'description' => $request->filled('description') ? $request->description : $seller->description,
                'location' => $request->filled('location') ? $request->location : $seller->location,
                'password' => $request->filled('password') ? Hash::make($request->password) : null,
                'default_currency' => $request->filled('default_currency') ? $request->default_currency : Auth::user()->default_currency,
            ]);

            $seller->classifications()->sync($request->categories ?? []);

            if ($request->hasFile('profile_image')) {
                $seller->addMedia($request->profile_image)->toMediaCollection(UserEnum::USER_PROFILE_COLLECTION_NAME->value);
            }

            $seller->refresh();

            return $seller;
        });
    }

    public function toggleStore()
    {
        Auth::user()->update([
            'is_public_store' => ! Auth::user()->is_public_store,
        ]);
    }

    public function receiverOrderStore($request)
    {
        Auth::user()->update([
            'receiver_order' => $request->receiver_order,
        ]);

        return Auth::user();
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $seller = $this->findById($id);

            $seller->delete();
        });
    }

    public function changeSellerStatus($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $seller = $this->findById($id);

            $seller->update([
                'account_status' => $request->account_status,
                'seller_code' => $request->seller_code,
            ]);
        });
    }

    public function handleProductQrCode($seller): void
    {
        $writer = new PngWriter();

        $qrCode = QrCode::create($seller->seller_dynamic_link)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(400)
            ->setMargin(5)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

        $result = $writer->write($qrCode);

        $image = Str::uuid() . '.png';

        $result->saveToFile(storage_path("app/temp/$image"));

        $qrCode = storage_path("app/temp/$image");

        $seller->addMedia($qrCode)->toMediaCollection(SellerEnum::QR_CODE->name);
    }

    public function getPointSeller()
    {
        return Auth::user()->current_points;
    }

    public function getGeneral()
    {
        return Seller::where('is_public_store', 1)
            ->planExpiredAt()
            ->where('account_status', SellerEnum::ACCEPTED->name)
            ->get();
    }

    public function getGeneralStore($id)
    {
        return Seller::where('is_public_store', 1)
            ->planExpiredAt()
            ->where('id', $id)
            ->where('account_status', SellerEnum::ACCEPTED->name)
            ->first();
    }
}
